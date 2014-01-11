<?php
// +----------------------------------------------------------------------
// | 自动化操作数据库
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
 
class BuilderView extends Widget{
	public $model;
	static $file;  
	//配置文件
  	public $config; 
  	protected $db;
  	public $update = false;
  	//是否为存在表单形式，默认是
  	public $save = true;
  	public $table;
  	public $row;
  	public $id;
  	protected $_multiLanguage = false;
  	public $editUrl;
	public $createUrl;
	/**
	* 关联表的信息， 数组key为字段名，值为完整表名
	*/
	protected $relation_table;
	function run(){  
		$this->db = Yii::app()->db->createCommand(); 
		//取得文件完整路径
		$file = Yii::getPathOfAlias($this->config).'.php'; 
		
		//取得文件配置信息
 		$row = self::loadFile($file);  
 		$this->model=new AutoModel; 
 		//验证规则
 		$this->model->rules = $row['_rules'];
 		$_AutoModel = $row['_AutoModel'];
 		//关联表的表名
 		$this->relation_table = $row['_relation_table']; 
 		$_config = cache('config');
 		if(!$_config['mlanguage']){
 			unset($row['_multiLanguage'],$row['language_id']);
 		}
 		//判断是不是启用了多语言
 		$this->_multiLanguage = $_multiLanguage = $row['_multiLanguage'];
 		$data['error'] = $row['_error']; 
 		unset($row['_rules'],$row['_error'],$row['_AutoModel'],$row['_multiLanguage'],$row['_relation_table']);  
 		$this->row = $row; 
 		if(!$this->table){
 			//取得数据库的名称
			$this->table = substr($this->config,strrpos($this->config,'.')+1);
 		}  
 	 	//判断是否是更新
 	 	if(true === $this->save){
	 		$id = (int)$this->id;
			if($id){ 
				$dbRow = $this->db->from($this->table)->where('id=:id',array(':id'=>$id))->queryRow(); 
				if($dbRow){
					$this->update = true;
					$node_id = $dbRow['id'];
					//取数据库中原来的UUID
					$uuid = $dbRow['uuid'];
					foreach($row as $key=>$value){
						$row[$key]['value'] = $dbRow[$key];
						$this->model->$key = $dbRow[$key];
					}
					/**
					* 取得关联表的值
					*/
					if($this->relation_table){
						// key是字段名 ,value是表名 
						foreach($this->relation_table as $key=>$value){
							$allR = CDB()->from($value)->where('nid=:nid',array(':nid'=>$node_id))->queryAll();
							if($allR){
								foreach($allR as $al){ 
									$all[$key][] = $al['value'];
								}
								foreach($all as $k=>$v){
									$_POST['Field'][$k] = $v;
								}
							}
						}
					}
				}
			} 
		 	//设置模型对应的属性，供自动翻译多语言
			$this->model->set_attrs($row); 
			$fixVid = null;
			//启用多语言判断,多语言一定是有VID的 
			if(true===$_multiLanguage){
				if( $dbRow['vid'] && $dbRow['language_id'] != trim($_POST['AutoModel']['language_id']) ){
					$fixVid = $dbRow['vid']; 
				}
				$vid = $dbRow['vid'];
				/**
				* 已经存在的多语言记录
				*/
				$all = Yii::app()->db->createCommand()
							->from($this->table)
							->where("vid=:vid",array(':vid'=>$dbRow['vid']))
							->queryAll(); 
				foreach($all as $al){
					$muitLang[$al['language_id']] = $al['id'];
				}
				
			}
			if(isset($_POST['AutoModel']))
			{	 
				
				//关联到其他表的值
				$NodeField = $_POST['NodeField'];
				if($NodeField){
					foreach($NodeField as $key=>$value){
						//关联表名
						$rale = $this->relation_table[$key];
						//用来保存到数据库的
						$relation_datas[$rale] = $value;
					}
				}
			  
				//对AutoModel属性赋值
				foreach($row as $key=>$value){ 
					//当字段配置中 insert 值为false时不写入主表
					if($value['insert'] === false) continue;
					$this->model->$key = trim($_POST['AutoModel'][$key]); 
					$saveDatas[$key]   = trim($_POST['AutoModel'][$key]);
				}  
			 
				//验证规则
			 	if($this->model->validate()){  
			 		$column = cache('DBColumns_'.$this->table);
			 		if(!$column){
				 		$columns = Yii::app()->db->createCommand("SHOW  COLUMNS FROM  `".$this->table."`")->queryAll();
				 		foreach($columns as $c){
				 			$column[$c['Field']] = $c['Field'];
				 		}
			 		}
			 		/**
			 		* 自动加载 application.components.AutoModel 下的文件
			 		*/
			 		 
			 		$insertDatas = array();
			 		$updateDatas = array();
			 		if($_AutoModel){
				 		foreach($_AutoModel as $AutoModel){
				 		 	$AutoModel = $AutoModel.'AutoModel';
			 				Yii::import("application.components.AutoModel.$AutoModel");
			 				$objModel = new $AutoModel;
			 				if(method_exists($AutoModel,'insert')){ 
			 					$insertDatas += $objModel->insert($saveDatas); 
			 				}
			 				if(method_exists($AutoModel,'update')){
			 					$updateDatas += $objModel->update($saveDatas);
			 				}  
			 				if(method_exists($AutoModel,'after')){
			 					$after[] = $objModel;
			 				}  
			 			 	/**
			 			 	* 判断字段是否存在
			 			 	*/
			 				if(is_array($objModel->fields)){
			 					foreach($objModel->fields as $v){
			 						if(!$column[$v]){
			 							unset($insertDatas[$v],$updateDatas[$v]);
			 						}
			 					}
			 				}else{
			 					$v = $objModel->fields;
			 					if(!$column[$v]){
		 							unset($insertDatas[$v],$updateDatas[$v]);
		 						}
			 				} 
				 		 
				 		} 
			 		}
			 		//如果不是更新，将取AUTOMODEL里面的UUID值 
			 		if(!$uuid){
			 			$uuid = $insertDatas['uuid'];
			 		}
			 	 
			 		if(true === $this->update){
			 			/**
			 			* 判断更新需要操作的字段
			 			*/
			 			if($fixVid){
			 				$updateDatas['vid'] = $fixVid;
			 			}
			 			if($updateDatas){
			 				foreach($updateDatas as $_k=>$_v){
			 					$saveDatas[$_k] = $_v;
			 				}
			 			} 
			 			if($fixVid){
			 				$this->db->insert($this->table, $saveDatas);
			 			}else{
			 				unset($saveDatas['vid']);
			 				$this->db->update($this->table, $saveDatas, 'id=:id', array(':id'=>$id));
			 			} 
			 		}else{ 
			 			/**
			 			* 判断写入需要操作的字段
			 			*/
			 			if($insertDatas){
			 				foreach($insertDatas as $_k=>$_v){
			 					$saveDatas[$_k] = $_v;
			 				}
			 			} 
			 			$this->db->insert($this->table, $saveDatas);
			 		}
			 		 
			 	 
			 		//写入主表完成，写入关联表
			 		if($relation_datas){ 
			 			/**
			 			* 当没有node_id 时，也就是新建操作时，将查寻一次数据库取得node_id的值
			 			*/
			 			if(!$node_id){
			 				$row = $this->db->from($this->table)->where('uuid=:uuid',array(':uuid'=>$uuid))->queryRow();  
							$node_id = $dbRow['id'];
			 			}
			 			foreach($relation_datas as $RT=>$volist){
			 				CDB()->delete($RT,'nid=:nid',array(
			 					':nid'=>$node_id, 
			 				));
			 				foreach($volist as $vo){
				 				CDB()->insert($RT,array(
				 					'nid'=>$node_id,
				 					'value'=>$vo, 
				 				));
			 				}
			 				
			 			}
			 		}
			 		//所以操作后
			 		if($after){
			 			foreach($after as $af){
			 				$af->after($this->db,$this->table,$data,$id);
			 			}
			 		} 
			 	 	if(true===$_multiLanguage){
						cache('language_'.$this->table.$vid,false); 
					}
			 	 
			 	 	flash('success',__('success'));
			 		$this->controller->refresh();
			 	}
			} 
	 	  	if(!$this->editUrl)
		    	$this->editUrl = $this->controller->module->id.'/'.$this->controller->id.'/update';
		    if(!$this->createUrl)
		    	$this->createUrl = $this->controller->module->id.'/'.$this->controller->id.'/create'; 
			$data['model']  = $this->model;
			$data['row']    = $row;
			$data['multiLanguage'] = $this->_multiLanguage;
			$data['muitLang'] = $muitLang;
			$data['createUrl'] = $this->createUrl;
			$data['editUrl'] = $this->editUrl;
			$this->render('BuilderView',$data);
		}
	}
	
	function loadFile($file){
 		if(!self::$file[md5($file)])
 			self::$file[md5($file)] = @include $file;
 		return self::$file[md5($file)];
 	}
}
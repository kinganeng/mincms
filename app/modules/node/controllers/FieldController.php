<?php
// +----------------------------------------------------------------------
// | 字段 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class FieldController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('node.default');
	public $_id;
	public $type;
	function init(){
		parent::init(); 
		if(true !== YII_DEBUG)exit('access deny!');
		$list = scandir(Yii::getPathOfAlias('application.fields'));
		foreach($list as $v){
			$ext = substr($v,-4);
			if($ext=='.php'){
				$n = trim(substr($v,0,-4));
				$this->type[$n] = $n;
			}
		} 
	}
	//字段列表
	function actionIndex($id){ 
		$data['id'] = $id;
		$row = Yii::app()->db->createCommand()->from("node_content")
				->where("id=:id",array(':id'=>$id))->queryRow();
		$data['title'] = $row['name'];
		$data['id'] = (int)$id;
		$this->render('index',$data);
	}
	function _cache(){
		cache('node__content_field',false);
	}
	/**
	* 对字段类型AJAX请求，生成HOOK，以及可能需要的HTML
	* 当类型为relation的时候会生成HTML
	*/
	function actionAjax(){
		/**
		* 对字段加载HOOK
		*/
		$type = $_POST['id']; 
		$objType = new $type;
		if(method_exists($objType,'hook')){
			 $objType->hook(); 
		}
		// 对Field 添加时 生成HTML
		if(method_exists($objType,'view')){
			echo $objType->view(); 
		}  
	}
	/**
	ckeditor:
		tag:AutoModel_body 
	attachment:
		tag:AutoModel_body	
	*/
	function actionCreate($id){ 
		$cont = NodeContent::model()->findByPk($id);  
		$model=new NodeField;  
		$model->display = 1;
		$model->node_content_id = $id; 
		if(isset($_POST['NodeField']))
		{
			$model->attributes=$_POST['NodeField']; 
			$model->name=trim($model->name);
			$model->widget=$_POST['NodeField']['widget']; 
			$model->rules=$_POST['NodeField']['rules'];
			$model->indexes=$_POST['NodeField']['indexes'];
			$model->search=$_POST['NodeField']['search'];
			$model->value=$_POST['NodeField']['value'];
			$model->type=$_POST['NodeField']['type'];
			$model->default_value=$_POST['NodeField']['default_value'];
			$model->memo=$_POST['NodeField']['memo'];
			$model->automodel=$_POST['NodeField']['automodel'];
			$model->label=$_POST['NodeField']['label'];
			$model->mvalue=$_POST['NodeField']['mvalue']; 
			$model->mysql_ext=$_POST['NodeField']['mysql_ext']; 
			$model->relation=$_POST['NodeField']['relation'];
			if($model->save()){
				$table = trim($cont['name']);
				$this->createTable($table);
				//创建关联表
				if($model->mvalue==1){
					if($model->relation){ 
						$this->createTableR($table,trim($model->name));
					}else{
						//创建普通的字段
						$this->add($table,$model);
					}
				}
				else{
					//创建普通的字段
					$this->add($table,$model);
				}
				$this->_cache();
				$this->redirect(array('index','id'=>$id));
			}
		}
	 
		$this->render('create',array(
			'model'=>$model,
			'cont'=>$cont,
			'type'=>$this->type,
			'id'=>$id,
		));  
	}
	
	function actionUpdate($id){ 
		$model= NodeField::model()->findByPk($id); 
		$cont = NodeContent::model()->findByPk($model->node_content_id);  
		$model->display = 1; 
		if(isset($_POST['NodeField']))
		{
			unset($_POST['NodeField']['node_content_id']);
			$model->attributes=$_POST['NodeField']; 
			$model->widget=$_POST['NodeField']['widget']; 
			$model->rules=$_POST['NodeField']['rules']; 
		 	$model->indexes=$_POST['NodeField']['indexes'];
			$model->search=$_POST['NodeField']['search'];
			$model->value=$_POST['NodeField']['value'];
			$model->type=$_POST['NodeField']['type'];
			$model->default_value=$_POST['NodeField']['default_value'];
			$model->memo=$_POST['NodeField']['memo'];
			$model->automodel=$_POST['NodeField']['automodel'];
			$model->label=$_POST['NodeField']['label'];
			$model->mvalue=$_POST['NodeField']['mvalue'];
			
			if($model->save())
				$this->redirect(array('index','id'=>$model->node_content_id));
		}
		
	 
		$this->render('create',array(
			'model'=>$model,
			'cont'=>$cont,
			'type'=>$this->type,
			'id'=>$model->node_content_id
		));  
	}
 	public function actionDelete()
	{ 
		$name = decode($_GET['name']); 
		$id = (int)$_GET['id'];
		$display = 1;
		if($id && $name){
			$row = Yii::app()->db->createCommand()->from($name)
				->where("id=:id",array(':id'=>$id))->queryRow();
			if($row['display'] == 1)
				$display = 0;
			Yii::app()->db->createCommand()
					->update($name,array('display'=>$display),"id=:id",array(':id'=>$id));
			flash('success',__('success'));		
		}
		
	 	$this->redirect(url('node/field/index',array('id'=>$row['node_content_id'])));
	}
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids'];  
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "node__field";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	Yii::app()->db->createCommand()->update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}    
 		return 1; 
	}
	function add($table,$model){
		$table = "field_".$table;
		$name = $model->name;
		$var = "varchar(255)";
		switch($model->type){
			case "text":
				$var = "text";
				break;
			case "select":
				$var = "int(11)";
				break;
			case "checkbox":
				$var = "int(11)";
				break;
		}
		if($model->relation) $var = "int(11)";
		if($model->mysql_ext)
			$var = $model->mysql_ext;
		$sql = "ALTER TABLE $table ADD  ".$name." ".$var." NOT NULL;";
		CDB($sql)->execute();
	} 
	function createTable($name){
		if(!$name) return;
		$name = "field_".$name;
		$v = " varchar(255) NOT NULL";
		$t = " text NOT NULL";
		$t = " int(11) NOT NULL";
		$sql = "CREATE TABLE IF NOT EXISTS `".$name."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT, 
			  `uid` int(11) NOT NULL,
			  `created` int(11) NOT NULL,
			  `updated` int(11) NOT NULL,
			  `sort` int(11) NOT NULL,
			  `language_id` int(11) NOT NULL,
			  `display` tinyint(1) NOT NULL DEFAULT '1',
			  `vid` varchar(255) NOT NULL,
			  `uuid` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
		CDB($sql)->execute();
	}
	/**
	* 创建关联表 
	*/
	function createTableR($name,$relation='relation'){
		if(!$name) return;
		$name = "field_".$name."_".$relation;
		$v = " varchar(255) NOT NULL";
		$t = " text NOT NULL";
		$t = " int(11) NOT NULL";
		$sql = "CREATE TABLE IF NOT EXISTS `".$name."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT, 
			  `nid` int(11) NOT NULL, 
			  `value` int(11) NOT NULL,  
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
		CDB($sql)->execute();
	}
}
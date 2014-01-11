<?php 
// +----------------------------------------------------------------------
// | 模块管理，包含安装卸载
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class ModuleController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('admin.module','admin.default');  
	public $bin;
	public $name;
	public $pwd;
	public $db_name;
	public $host;
	public $app;
	/**
	* 内核主要模块，不能改动。
	*/
	protected $_core_modules = array(
		'admin'=>'admin', 'menu'=>'menu','image'=>'image','i18n'=>'i18n'
	);
	
	function init(){ 
		parent::init();
 		$this->app = \Yii::getPathOfAlias('application.modules').'/';
		foreach($this->_core_modules as $m){
			$load = Modules::model()->find(array(
				'condition'=>'name=:name',
				'params'=>array(':name'=>$m),
			)); 
			if($load) continue;
			$this->load_module($m,true);
		}
		$row = Yii::app()->db->createCommand("SHOW VARIABLES LIKE '%basedir%'")->queryAll();
 	 	$this->bin = $row[0]['Value'].'/bin/'; 
		$dsn = Yii::app()->db->connectionString; 
		$n = explode(';',$dsn); 
		$this->host = substr( $n[0] ,strpos($dsn,'=')+1);   
		$this->db_name = substr( $dsn ,strrpos($dsn,'=') +1); 
		$this->name = Yii::app()->db->username;
		$this->pwd = Yii::app()->db->password; 
	}
	
	public function actionIndex()
	{     
		$models = Modules::model()->findAll(array(
				'condition'=>'active=:active',
				'params'=>array(':active'=>1),
				'order'=>'core asc,sort desc,id asc',
			)); 
		$array = array();
		if($models){
			foreach($models as $model){
				$name = $model->name;
				$array[$name]['name'] = $name;
				$array[$name]['active'] = $model->active;
				$array[$name]['core'] = $model->core;
				$array[$name]['path'] = $base.$name;
				$array[$name]['info'] = include $this->app.$name.'/info.php';
			}
		} 
		foreach (glob($this->app.'*') as $v)
		{ 
			$name = str_replace($this->app,'',$v); 
			$data[$name]['name'] = $name;
			$data[$name]['path'] = $v;
			$data[$name]['active'] = $array[$name]['active']?:false;
			$data[$name]['info'] = include $v.'/info.php'; 
			$file[$name] = $name;
		}  
	
		if($array){ 
 			$data = array_merge($data,$array); 
 		} 
 	   
		return $this->render('index',array('data'=>$data,'models'=>$models,'core'=>$this->_core_modules));
		 
	}
	protected function load_module($id,$flag=false){  
		$path = \Yii::getPathOfAlias("application.modules");
		$active = 1;
		$model = Modules::model()->findByAttributes(array('name'=>$id));
		if($model){
			if($model->active == 1)
				$active = 0;
		}
		else{
			$model = new Modules; 
	 	}
	 	$model->core = $flag;
	 	if(true === $flag) $active = 1;
		$info =  @include $path.$id.'/info.php'; 
		 
		$classes = $path.$id.'/class.php';  
	 
		$model->name = $id;
		$model->label = $info['label']; 
		$model->memo = $info['memo'];
		$model->active = $active; 
	 
		if(!$model->save()){ 
		}
	 
		/**
		* reload modules
		* 重新加载模块
		*/ 
		 
	 	return $model->active;
	}
	 
	/**
	* 安装数据库
	*/ 
	public function actionInstall($id){ 
		$id = $_GET['id'];  
		$moduleDir = \Yii::getPathOfAlias("application.modules"); 
		$file = $moduleDir."/$id/{$id}.sql";   
		$model = Modules::model()->findByAttributes(array('name'=>$id));  
		if(file_exists($file) && !$model){
			$sql = $this->bin."mysql -h ".$this->host." -u".$this->name." -p\"".$this->pwd."\" ".$this->db_name." <  ".$file; 
			exec($sql);  
		}
		$this->load_module($id); 
		flash('success',__('success'));
		//生成config/modules.php 
		$all = Modules::model()->findAll(array(
			'condition'=>'active=1',
		)); 
		$data = $this->_core_modules;
		if($all){
			foreach($all as $v){
				$data[$v->name] = $v->name;
			}
		}
		
	 
		$include = array();
		foreach($data as $v){
			$m[] = $v;   
			if(file_exists($moduleDir."/$v/function.php")){
				$include[] = "../modules/$v/function.php";
			} 
		}
		
	 
		file_put_contents(Yii::getPathOfAlias("application.config").'/modules.php',"<?php \n \$module_lists =  ".var_export($m,true)."; \$include = ".var_export($include,true).";");
	 
	 
		$ret = $_GET['ret'];
		if($ret)
			$this->redirect(url($ret));
		$this->redirect(url('admin/module/index'));
	}
	
}

<?php 
// +----------------------------------------------------------------------
// | 生成权限列表
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class AuthController extends AdminController
{ 
	public $layout='//layouts/column2';
	public $active = array('admin.group','admin.default'); 
	function init(){
		parent::init();
	 
	}
	/**
	* 用户组绑定权限
	*/
	public function actionIndex($id)
	{ 	
		$id = (int)$id;
		$model = Group::model()->findByPk($id);
		if($model->access){
			foreach($model->access as $g){
				$access[] =  $g->access_id;
			} 
		}
		$cache = cache('auth_controller_file');
		if(!$cache){ 
			$d = $this->_get_modules(\Yii::getPathOfAlias('application.modules'));   
			if($d)
		   		Access::generate($d);  
		   	DirHelper::$kep_list_file = false; 
		    
		   	cache('auth_controller_file',true);
	   	} 
	   	$rows = DB::all('access',array(
	   		'select'=>"id,name,pid"
	   	));
	     
		foreach($rows as $v){
			$out[$v['id']] = $v;
		}
		$rows = ArrHelper::_tree_id($rows); 
 	 	if($_POST){
 	 		$auth = $_POST['auth'];
 	 		GroupAccess::saveAccess($id,$auth);
 	 		cache('acl',false);
 	 		flash('success',__('set access success'));
 	 		$this->redirect(url('admin/auth/index',array('id'=>$id))); 
 	 	}
		return $this->render('index',array(
			'rows'=>$rows,
			'out'=>$out,
			'model'=>$model,
			'id'=>$id,
			'access'=>$access
		));
	}
	
	/**
	* get all controller as key ,actions as value
	*/
	protected function _get_modules($dir){
		unset($actions);
		$p = $dir;  
		$lists =  DirHelper::listFile($p,'Controller.php');   
		
		$dirs = $lists['dir'];   
		if(!$dirs) return; 
		$i=0; 
		foreach($dirs as $dir){ 
			$key = substr($dir,0,-4); 
			$name = str_replace($p,'',$key);
			if(substr($name,0,1)=='/') $name = substr($name,1); 
			$module_name =  substr($name,0,strpos($name,'/'));   
			$class = ucfirst(substr($key,strrpos($key,'/')+1)); 
			$line = @file_get_contents($dir);  
			preg_match_all('/.*class.*extends(.*)/i',$line,$out);    
			if(false!==strpos($out[1][0],'AdminController')) { 
				 $new_dirs[$module_name.'.'.$class."##".$i] = $dir; 
				 $i++;
			}  		

		}  
		if(!$new_dirs) return; 
		foreach($new_dirs as $k=>$dir){ 
			$lineNumber = 0; 
			$file = fopen($dir, 'r');
			while( feof($file)===false )
			{ 
				++$lineNumber;
				$line = fgets($file);
				preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
				if( $matches!==array() )
				{
					$name = $matches[1];
					$k = str_replace('Controller','',$k);
					$k = strtolower($k); 
					$actions[substr($k,0,strpos($k,'##'))][ strtolower($name) ] = array(
						'name'=>$name,
						'line'=>$lineNumber
					);
				
					
				}
			}
		} 
		return $actions; 
	}

	 
}

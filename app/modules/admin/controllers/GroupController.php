<?php   
// +----------------------------------------------------------------------
// | 用户组
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class GroupController extends AdminController
{ 
	public $layout='//layouts/column2';
	public $active = array('admin.group','admin.default');  
	public $key = "Group";
	function init(){
		parent::init();
		 
	}
	/**
	* 用户绑定到组
	*/
	public function actionBind($id)
	{ 	
		$id = (int)$id;
		$model = User::model()->findByPk($id); 
		foreach($model->groups as $g){
			$groups[] =  $g->group_id;
		}  
		$rows = Group::model()->findAll();
		if($rows)
			$rows = \ArrHelper::model_tree($rows); 
 	 	if($_POST){
 	 		$group = $_POST['group'];
 	 	 	//绑定用户到组
 	 		UserGroup::UserGroupSave($id,$group); 
 	 		flash('success',__('bin user group success'). " # ".$id);
 	 		$this->redirect(url('admin/user/index',array('id'=>$id))); 
 	 	}
 	  
		return $this->render('bind',array(
			'rows'=>$rows, 
			'groups'=>$groups,
			'model'=>$model,
			'id'=>$id,
		 	'self'=>$model->yourself
		));
	}
	public function actionCreate()
	{    
		$model = new Group();
	 	$model->scenario = 'create';  
	 	$list = $model->dropDownList();
		if (isset($_POST[$this->key])) {  
			$model->attributes=$_POST[$this->key]; 
			if($model->save()){ 
			 	flash('success',__('create group sucessful'));
				$this->refresh();
			}
		} 
		$this->render('form', array(
		   'model' => $model,
		   'name'=>'group_create', 
		   'list'=>$list
		));
	}
	public function actionUpdate($id)
	{   
		$model = Group::model()->findByPk($id);
		$list = $model->dropDownList();
	 	$model->scenario = 'update';
		if (isset($_POST[$this->key])) {  
			$model->attributes=$_POST[$this->key]; 
			if($model->save()){ 
			 	flash('success',__('create group sucessful'));
				$this->refresh();
			}
		} 
		return $this->render('form', array(
		   'model' => $model, 
		   'name'=>'group_create',
		    'list'=>$list
		));
	}
	 
	public function actionIndex()
	{    
		
		$model=new Group('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Group']; 
		$this->render('index',array(
			'model'=>$model,
		)); 
	 
	}

	 
}

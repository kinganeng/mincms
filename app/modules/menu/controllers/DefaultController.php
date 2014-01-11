<?php
// +----------------------------------------------------------------------
// | 菜单管理 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class DefaultController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('menu.default','admin.default');
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCreate()
	{
		if($_POST){
			cache('menus',false); 
		}
		$this->render('create');
	}
	public function actionUpdate()
	{
		if($_POST){
			cache('menus',false); 
		}
		$this->render('update');
	}
	
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids']; 
 	 	$slug = $_POST['name']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "menus";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	Yii::app()->db->createCommand()->update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}   
 		cache('menu_module',false);
 		cache('menus',false);
 		return 1; 
	}
}
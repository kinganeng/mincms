<?php
// +----------------------------------------------------------------------
// | 相册 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class DefaultController extends AdminController
{
	public $active = "album.default";
	public $layout='//layouts/column2';
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCreate()
	{
	 
		$this->render('create');
	}
	public function actionUpdate()
	{
	 
		$this->render('update');
	}
	
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids']; 
 	 	$slug = $_POST['name']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "albums";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	Yii::app()->db->createCommand()->update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}   
 		cache('menu_module',false);
 		return 1; 
	}
}
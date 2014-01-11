<?php
// +----------------------------------------------------------------------
// | 视频 
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
	public $active = "video.default";
	public function actionView()
	{
		$id = (int)$_GET['id'];
		if($id>0){
			$row = CDB()->from('videos')->where('id=:id',array(':id'=>$id))->queryRow(); 
			$this->render('view',$row);
		}
	}
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
		if(true===Yii::app()->request->isAjaxRequest){
			Yii::app()->controller->layout = false;
		} 
		$this->render('update'); 
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
	 	$this->redirect(url('post/default/index'));
	}
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids'];  
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "posts";
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
}
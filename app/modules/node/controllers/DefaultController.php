<?php
// +----------------------------------------------------------------------
// | NODE 
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
	public $active = array('node.default');
	function init(){
		parent::init(); 
		if(true !== YII_DEBUG)exit('access deny!');
	}
 
	public function actionIndex()
	{ 
		$this->render('index');
	}
	public function actionCreate()
	{
		cache('node__content',false);
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
		cache('node__content',false);
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
	 	$this->redirect(url('node/default/index'));
	}
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids'];  
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "node_content";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	Yii::app()->db->createCommand()->update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}    
 		cache('node__content',false);
 		return 1; 
	}
	
}
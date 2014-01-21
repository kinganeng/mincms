<?php
// +----------------------------------------------------------------------
// | QUERY For Node 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class QueryController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('node.default');
	public $table;
	public $getid;
	public $title;
	function init(){
		parent::init(); 
		$this->getid = (int)$_GET['fid'];
		$model = NodeContent::model()->findByPk($this->getid);
		$this->table = "field_".trim($model->name);
		$this->title = __($model->discription)?:__($model->name);
	}
 
	public function actionIndex()
	{ 
		return_url(url('node/query/index',array('fid'=>$this->getid)));
		$this->render('index',array(
			'table'=>$this->table,
			'fid'=>$this->getid,
			'title'=>$this->title,
		));
	}
	public function actionCreate()
	{ 
		$this->render('create',array(
			'table'=>$this->table,
			'fid'=>$this->getid,
			'title'=>$this->title,
		));
	}
	public function actionUpdate()
	{   
		$this->render('update',array(
			'table'=>$this->table,
			'fid'=>$this->getid,
			'title'=>$this->title,
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
			$this->redirect(return_url());
		}
	 	
	}
	public function actionSort(){  
 		$ids = $sort = $_POST['ids'];   
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = $_POST['table'];
 		if(!$table) exit;
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
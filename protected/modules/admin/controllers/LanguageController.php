<?php
// +----------------------------------------------------------------------
// | 多语言
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class LanguageController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('admin.language','admin.default');
	function init(){
		parent::init(); 
		if(!$this->_config['mlanguage']){
			flash('error',__('please open muit language support'));
			$this->redirect(url('admin/default/index'));
		}
		
	}
	public function actionIndex()
	{
		$row = Yii::app()->db->createCommand()
			->from('languages')
			->where('is_default=:is_defautl',array(':is_defautl'=>1))
			->queryRow();
		$name = $row['name']?$row['name']:__('not set');
		$this->render('index',array('name'=>$name));
	}
	public function actionCreate()
	{
		if($_POST){
			cache('defaultDBLanguge',false); 
		}
		$this->render('create');
	}
	public function actionUpdate()
	{
		if($_POST){
			cache('defaultDBLanguge',false);	
		}
		$this->render('update');
	}
}
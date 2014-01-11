<?php
// +----------------------------------------------------------------------
// | 分类
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class CategoryController extends AdminController
{
	public $layout='//layouts/column2';
	public $active = array('admin.category','admin.default');
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
}
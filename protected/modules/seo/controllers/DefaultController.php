<?php
// +----------------------------------------------------------------------
// | SEO
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
	public $active = array('seo.default','admin.default');
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
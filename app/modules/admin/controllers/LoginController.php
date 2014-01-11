<?php
// +----------------------------------------------------------------------
// | 登录 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class LoginController extends AdminController
{
	public $allow = array('index');
	public function actionIndex()
	{ 
		$this->layout = '//layouts/none';
		$model=new LoginForm; 
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm']; 
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect( url('admin/default/index'));
		}
		// display the login form
		$this->render('index',array('model'=>$model));
	}
	
}
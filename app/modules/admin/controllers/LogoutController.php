<?php
// +----------------------------------------------------------------------
// | ÍË³ö
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class LogoutController extends Controller
{
	public function actionIndex()
	{ 
		Yii::app()->user->logout();
		$this->redirect(url('admin/login/index'));
 
	}
	
}
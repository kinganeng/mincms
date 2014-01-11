<?php 
// +----------------------------------------------------------------------
// | 配合pupload 这个 widget  使用
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class PluploadController extends AdminController
{
 
	/**
	* 管理员上传
	*/
	function actionIndex(){ 
		$name = $_REQUEST['field'];  
 		if(!$name) exit;
 		$file = new FileHelper;
 		$file->uid = Yii::app()->user->id;
 		$file->admin = 1; 
		$rt = $file->upload();   
		if(!$rt) return; 
		$new[] = $rt;  
		$out = FileHelper::input($new,$name);
		echo $out;
		exit(); 
	}
	
}

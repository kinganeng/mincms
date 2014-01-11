<?php
// +----------------------------------------------------------------------
// | AutoModel 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class AdminUidAutoModel{
	
	public $fields = array('uid');
	
	function insert(){
		$model['uid'] = Yii::app()->user->id;
		return $model;
	}
	function update(){
		$model['uid'] = Yii::app()->user->id;
		return $model;
	}

}
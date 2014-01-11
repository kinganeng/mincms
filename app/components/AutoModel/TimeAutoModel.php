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

class TimeAutoModel{
	
	public $fields = array('created','updated');
	
	function insert(){
		$model['created'] = time();
		$model['updated'] = time();
		return $model;
	}
	function update(){
		$model['updated'] = time();
		return $model;
	}

}
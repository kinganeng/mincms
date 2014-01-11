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

class VidAutoModel{
	
	public $fields = array('vid');
	
	function insert(){
		$data['vid'] = uuid();
		return $data;
	}
	function update(){
		$data['vid'] = uuid();
		return $data;
	}

}
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
/**
* 清除除了当前行字段外 的所有值
*/
class CleanAutoModel{
	
	public $fields = array('is_default');
	
	function after($db,$table,$data,$id){ 
		 if(!$id) return;
		 unset($value);
		 foreach($this->fields as $v){  
		 	$value[$v] = 0; 
		 	$db->update($table,$value, 'id!=:id', array(':id'=>$id));
		 } 
	}
	 

}
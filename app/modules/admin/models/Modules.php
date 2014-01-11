<?php
// +----------------------------------------------------------------------
// | MODEL 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +---------------------------------------------------------------------- 
class Modules extends ActiveRecord
{
 
	public $old_pid;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public  function tableName()
    {
        return 'modules';
    } 
    
	public function rules()
	{ 
		return array(
			array('name', 'required'), 
		);
	}   
	function getIds(){
	    return "<input type='hidden' class='ids' name='ids[]' value='".$this->id."'>".$this->name;
	}
 
	 
}
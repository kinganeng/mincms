<?php
// +----------------------------------------------------------------------
// | NodeModel MODEL 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class NodeModel extends ActiveRecord
{
   
    static $_table;
    
	public function tableName()
	{ 
		return static::$_table;
	} 
	 
	
 	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	 
	public function __get($name)
    {
    	try {
		    return parent::__get($name);
		} catch (Exception $e) {
		     
		}
    	 
    }
	 
	
 
    
}

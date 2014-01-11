<?php
// +----------------------------------------------------------------------
// | 自动MODEL
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

 
class AutoModel extends Model
{ 
	public $rules; 
  	
  	public function rules()
    {
        return $this->rules;
    }
	public function __get($name) { 
		if(!isset($this->$name)) { 
			return null;
		}  
	}
	
	public function __set($name,$value)
	{
		$this->$name = $value;
	}
	/*
 	* 属性自动翻译
 	*
 	*/
	public function attributeLabels()
	{  
		if(self::$_attrs){
			foreach(self::$_attrs as $v){
				$out[$v] = __($v);
			}
		}
		return $out;
	}
	static $_attrs;
	function set_attrs($row){
		foreach($row as $k=>$v){
			self::$_attrs[$k] = $k;
		}
	} 
 

	 
}

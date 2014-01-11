<?php  
// +----------------------------------------------------------------------
// | Hook,如果Hook::init('init[].application',function(){}) 带[] 说明是数组 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class Hook
{ 
   static $hook;
   /**
   *  以.分隔，且只能出现一次，调用时直接使用 Hook::run('init');
   Hook::init('init[].node_content',function(){
	
   })
   */
   static function init($name,$fun){ 
   	 if(strpos($name,'[]')===false){
   	 	static::$hook[$name] = $fun;
   	 	return;
   	 }
   	 $arr = explode('.',$name);  
	 static::$hook[$arr[0]][$arr[1]] = $fun;
   }
   /**
   * 需要 5.3+
   */
   static function run($name='init[]',$object = null){ 
   	   if(!static::$hook[$name]) return; 
   	   if(strpos($name,'[]')===false){ 
   	   		$v = static::$hook[$name];
   	   		$v($object);
   	   		return;
   	   }
   	   foreach(static::$hook[$name] as $k=>$v){
   	   		$v($object);
   	   } 
 	}
}
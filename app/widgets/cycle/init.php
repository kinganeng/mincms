<?php 
/**
*   
* @link http://jquery.malsup.com/cycle/
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Cycle_Init extends CWidget
{  
 	public $tag;
 	public $options;   
	function run(){   
		$base = publish(dirname(__FILE__).'/assets');   
	  	if($this->options)
			$opts = CJavaScript::encode($this->options);  
		$tag = $this->tag; 
 		js_code('  
	 		$("'.$tag.'").cycle('.$opts.');
 		'); 
 		js($base.'/jquery.cycle.all.js');
 		
	}
}
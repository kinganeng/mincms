<?php  
/**
* 
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Select2_Init extends CWidget{ 
    public $tag='select';
    public $params;
 	function run(){  
		if($this->params)
			$opts = CJavaScript::encode($this->params);
		$base = publish(dirname(__FILE__).'/select2-3.3.2'); 
		core_js('jquery'); 
 		css($base.'/select2.css');  
 		js($base.'/select2.js'); 
 		if(!$this->tag) return;	  
 		js_code('select2_'.$this->tag," 
 			$('".$this->tag."').select2($opts); 
 		"); 
	  
 	}
	 
	
}
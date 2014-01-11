<?php  
/**
* 
* @link http://fancyapps.com/fancybox/
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Fancybox_Init extends CWidget{ 
    public $tag='.fancybox';
    public $options;
 	function run(){  
		if($this->options)
			$opts = CJavaScript::encode($this->options);
		$base = publish(dirname(__FILE__).'/assets'); 
		core_js('jquery'); 
 		 
 		css($base.'/jquery.fancybox.css?v=2.1.5'); 
 		css($base.'/jquery.fancybox-buttons.css?v=1.0.5');  
 		css($base.'/jquery.fancybox-thumbs.css?v=1.0.7');  
 		js($base.'/jquery.mousewheel-3.0.6.pack.js');
 		js($base.'/jquery.fancybox.pack.js?v=2.1.5'); 
 		js($base.'/jquery.fancybox-buttons.js?v=1.0.5');  
 		js($base.'/jquery.fancybox-media.js?v=1.0.6');  
 		js($base.'/jquery.fancybox-thumbs.js?v=1.0.7');  
 		if(!$this->tag) return;	  
 		js_code("
 			$('".$this->tag."').fancybox($opts); 
 		"); 
	  
 	}
	 
	
}
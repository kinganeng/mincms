<?php  
/**
* widget("imagesloaded",array('tag'=>'img'));	
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Imagesloaded_Init extends CWidget{ 
    public $tag;
    public $options;
 	function run(){  
		if($this->options)
			$opts = CJavaScript::encode($this->options);
		$base = publish(dirname(__FILE__).'/assets'); 
		core_js('jquery');  
 		js($base.'/imagesloaded.js'); 
 		if(!$this->tag) return;	  
 		js_code('Imagesloaded_'.$this->tag," 
 			$('".$this->tag."').imagesLoaded($opts); 
 		"); 
	  
 	}
	 
	
}
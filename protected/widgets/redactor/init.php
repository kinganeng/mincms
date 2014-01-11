<?php  

class Widgets_Redactor_Init extends CWidget{ 
    public $tag;
    public $params;
 	function run(){  
		if($this->params)
			$opts = CJavaScript::encode($this->params);
		$base = publish(dirname(__FILE__).'/redactor'); 
		core_js('jquery'); 
 		css($base.'/redactor.css'); 
 		//script($base.'/redactor.js'); 
 		js($base.'/redactor.zh.js'); 
 		if(!$this->tag) return;	 
 	 	
 		js_code('redactor_'.$this->tag," 
 			$('".$this->tag."').redactor($opts); 
 		"); 
	  
 	}
	 
	
}
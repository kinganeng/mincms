<?php  
/**
* 
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Checkbox_Init extends CWidget{ 
	public $tag = 'input'; 
    /**
 	* array options
 	*/
 	public $options;  
 	/**
 	* skin set values square/flat/minimal/
 	*/
 	public $skin = 'flat';
 	/**
 	* color
 	*/
 	public $color = 'blue';
 	/**
	*  
	* Example :
	*  
	* <code> 
	*	widget('icheck' , array(
	*		'skin'=>'flat', 
	*		'color'=>'blue'
	*	));
	*</code> 
	*/ 
 	function run(){  
	 
		
		
		$this->options['checkboxClass'] = $this->options['checkboxClass']?$this->options['checkboxClass']:'icheckbox_'.$this->skin;
	 	$this->options['radioClass'] = $this->options['radioClass']?$this->options['radioClass']:'iradio_'.$this->skin;
	 	if($this->color){
	 		$this->options['checkboxClass'] .= "-".$this->color;
	 		$this->options['radioClass'] .= "-".$this->color;
	 	}
	 	$opts = CJavaScript::encode($this->options);
	 	
		$base = publish(dirname(__FILE__).'/assets'); 
		core_js('jquery'); 
 	 	js_code("$('".$this->tag."').iCheck($opts);");    
	  
	 	$skin = $this->skin."/".$this->skin;
	  	$color = $this->skin."/".$this->color;
		css($base.'/skins/'.$skin.'.css');
		css($base.'/skins/'.$color.'.css');
		css($base.'/skins/flat/blue.css');
		js($base.'/jquery.icheck.min.js');  
	  
 	}
	 
	
}
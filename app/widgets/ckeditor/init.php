<?php  
/**
* 
<?php
widget("ckeditor",array(
	'tag'=>'a'
)); 
?>

<textarea id='a' name='a'>tgest</textarea>
* 
* @author Sun 
* @email  68103403@qq.com 
*/
class Widgets_Ckeditor_Init extends CWidget
{  
 	public $tag = 'ckeditor';
 	public $options; 
 	public $var;
	function run(){  
		$this->var = $this->tag;
		if($this->options)
			$opts = ",".CJavaScript::encode($this->options);
		$base = publish(dirname(__FILE__).'/assets'); 
 		
 		if(!$this->tag) return; 
 		 
 		js_code(" 
 			".$this->var." = CKEDITOR.replace('".$this->tag."'".$opts."); 
 		"); 
 		js($base.'/ckeditor.js'); 
	}
}
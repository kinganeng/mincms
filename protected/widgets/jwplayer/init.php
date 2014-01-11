<?php 
/**
*  
<?php
widget("jwplayer",array(
	'tag'=>'#a',
	'file'=>'http://m.jwpcdn.com/sEtaWjfL/videos/RxiqSWej-zyqTZT48.mp4?5c877a8d15f183bb974dcdccb105a79495b4e5e3b1b6e4cf2779660e5393add50fa0db4366761033dbebc05eba17d9aa9433c8645cd98b019a7fbba1c8fecd3935207680ef54e39000f90012087984beaf7a9bd241fc',
	'image'=>'http://s.jwpcdn.com/thumbs/RxiqSWej-640.jpg',
));

?>

<div id='a' width=500 height=400></div>
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Jwplayer_Init extends CWidget
{  
 	public $tag;
 	public $options; // file
 	public $file ;  
 	public $image ; 
 	public $width = 400; 
 	public $height = 300 ; 
	function run(){   
		$base = publish(dirname(__FILE__).'/assets');   
	 	$this->options['flashplayer'] = $base."/jwplayer.flash.swf";
	 	$this->options['width'] = $this->options['width']?$this->options['width']:$this->width;
	 	$this->options['height'] = $this->options['height']?$this->options['height']:$this->height;
	 	if($this->file)
	 		$this->options['file'] = $this->file;
	 	if($this->image)
	 		$this->options['image'] = $this->image;
		$opts = CJavaScript::encode($this->options);  
		$tag = $this->tag;
		$tag = str_replace('#','',$tag);
		$tag = str_replace('.','',$tag);
 		js_code('  
	 		jwplayer("'.$tag.'").setup('.$opts.');
 		'); 
 		js($base.'/jwplayer.js');
 		
	}
}
<?php
 
$this->breadcrumbs=array(
	__('video'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<blockquote><?php echo $title;?></blockquote>
<div id='a' width=400 height=300></div>
<?php 
if(strpos($video,"http://")===false && strpos($video,"https://")===false){
	$video = base_url().'/'.$video;
	$image = base_url().'/'.$image;
} 
widget("jwplayer",array(
	'tag'=>'#a',
	'file'=>$video,
	'image'=>$image
));	
?>
<blockquote><?php echo __('body');?></blockquote>

<div class=' '><?php echo $body;?></div>
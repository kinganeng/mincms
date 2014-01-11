<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('post'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderIndex',array(
	'config'=>'application.modules.post.config.posts',
	'uisort'=>true,
));?>
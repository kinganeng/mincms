<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('video'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderIndex',array(
	'config'=>'application.modules.video.config.videos',
	'uisort'=>true,
	'action'=>array(
		'<span class="glyphicon glyphicon-facetime-video"></span>'=>'video/default/view',
	),
));?>
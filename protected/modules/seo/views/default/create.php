<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('seo'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderView',array(
	'config'=>'application.modules.seo.config.seo',
));?>
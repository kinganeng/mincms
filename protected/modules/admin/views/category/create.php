<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('category'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderView',array(
	'config'=>'application.modules.admin.config.category',
));?>
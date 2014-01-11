<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('menu'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderView',array(
	'id'=>(int)$_GET['id'],
	'config'=>'application.modules.menu.config.menus',
));?>
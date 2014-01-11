<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('language'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderView',array(
	'id'=>(int)$_GET['id'],
	'config'=>'application.modules.admin.config.languages',
));?>
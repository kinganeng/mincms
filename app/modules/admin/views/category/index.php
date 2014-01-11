<?php
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;


$this->breadcrumbs=array(
	__('category'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  $this->widget('BuilderIndex',array(
	'config'=>'application.modules.admin.config.category',
	'function'=>array(
		'where'=>"pid=".$pid,
	),
));?>
<?php
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;


$this->breadcrumbs=array(
	__('content type'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php  
	
$this->widget('BuilderIndex',array(
	'config'=>'application.modules.node.config.node_content',
	'uisort'=>true,
	'action'=>array(
		'<span class="glyphicon glyphicon-th"></span>'=>'node/field/index',
	),
));?>
<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	__('content type'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>url('node/query/index',array('fid'=>$fid))),
	array('label'=>__('create'), 'url'=>url('node/query/create',array('fid'=>$fid))),
);
?>
<?php  $this->widget('BuilderView',array(
	'id'=>(int)$_GET['id'],
	'config'=>'application.modules.node.config.query',
	'table'=>$table,
));?>
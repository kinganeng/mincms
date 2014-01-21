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
<blockquote><?php echo $title;?></blockquote>
<?php  $this->widget('BuilderView',array(
	'config'=>'application.modules.node.config.query',
	'table'=>$table,
));?>
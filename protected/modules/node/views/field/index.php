<?php
 

$this->breadcrumbs=array(
	__('content type'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>url('node/field/index',array('id'=>$id))),
	array('label'=>__('create'), 'url'=>url('node/field/create',array('id'=>$id))),
);
?>

<blockquote><?php echo $title;?></blockquote>
<?php  
	
$this->widget('BuilderIndex',array(
	'config'=>'application.modules.node.config.node_field',
	'function'=>array(
		'where'=>"node_content_id=$id",
		'order'=>'sort desc ,id asc',
	),
	'uisort'=>true, 
));?>
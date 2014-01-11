<?php
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;


$this->breadcrumbs=array(
	__('content type'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>url('node/query/index',array('fid'=>$fid))),
	array('label'=>__('create'), 'url'=>url('node/query/create',array('fid'=>$fid))),
);
?>
<?php  
	
$this->widget('BuilderIndex',array(
	'config'=>'application.modules.node.config.query',
	'uisort'=>true,
 	'table'=>$table,
 	'indexUrl'=>url('node/query/index',array('fid'=>(int)$_GET['fid'])),
 	'editUrl'=>array(
 		'node/query/update',
 		array(
 			'id'=>'{id}',
 			'fid'=>(int)$_GET['fid']
 		),
 	),
));?>
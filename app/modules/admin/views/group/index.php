<?php
$this->breadcrumbs=array(
	__('group')=>array('index'),
	__('manage'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
 
?>
<h1><?php echo __('manage');?></h1> 
 
<?php $this->widget('GridView', array(
	'id'=>'grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name', 
		array(
			'class'=>'CButtonColumn', 
			'template'=>'{update}  {bind}',
			'buttons'=>array(
			'bind' => array(
				    'label'=>'<span class="glyphicon glyphicon-wrench"></span>',  
				    'url'=>'url("admin/auth/index",array("id"=>$data->id))', 
				),
			)
		),
		
	),
)); ?>

<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	__('user')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
	array('label'=>__('update'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>__('delete'), 'url'=>'#', 
	'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
	'confirm'=>__('are you sure you want to delete this item?'))),

);
?>

<h1><?php echo __('view');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'created',
		'updated',
	),
)); ?>

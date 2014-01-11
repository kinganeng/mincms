<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	__('user')=>array('index'),
	$model->id=>array(__('view'),'id'=>$model->id),
	__('update'),
);

$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
 	array('label'=>__('create'), 'url'=>array('create')),
	array('label'=>__('view'), 'url'=>array('view', 'id'=>$model->id)),
	
);
?>

<h1><?php echo __('update');?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
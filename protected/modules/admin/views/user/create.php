<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	__('user')=>array('index'),
	__('create'),
);

$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
 
);
?>

<h1><?php echo __('create');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
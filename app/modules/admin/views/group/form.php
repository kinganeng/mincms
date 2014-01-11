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

<div class="form"> 
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'user-form', 
)); ?> 
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
	</div>
		
	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
	</div>
 	<div class="form-group">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->dropDownList($model,'pid',$list); ?>
	</div>
	 	

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? __('create') : __('save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
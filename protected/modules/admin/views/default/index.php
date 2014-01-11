<?php widget('checkbox');?>
<div class="row">
  <div class="col-lg-12">
    <h1><?php echo __('system config');?></h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> <?php echo __('setting');?></li>
    </ol>
      
  </div>
</div><!-- /.row -->
	  
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'form-'.mt_rand(0,9999),
	'enableAjaxValidation'=>false,
)); ?> 
 
	<div class="form-group">
		<label><?php echo __('title');?></label>
		<?php echo CHtml::textField('config[title]',$title,array("class"=>"form-control"));?>
	</div> 
	<div class="form-group">
		<label><?php echo __('seo');?></label>
		<?php echo CHtml::textArea('config[seo]',$seo,array("class"=>"form-control"));?>
	</div> 
	<div class="form-group">
		<label><?php echo __('muit language support');?></label>
		<?php echo CHtml::checkBox('config[mlanguage]',$mlanguage,array());?>
	</div> 

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? __('create') : __('save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?> 
 
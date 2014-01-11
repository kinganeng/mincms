 
<div style='margin-top:20px;'>
	
		
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'form',
	'enableAjaxValidation'=>false,
	
)); ?> 
<?php if($error){?>
	<div class='alert alert-danger'><?php echo $error;?></div>
<?php }?>
<?php echo $form->errorSummary($model); ?>
<div class="row">
  <div class="col-lg-4">
	  <fieldset>
	    <legend>Install MinCMS </legend>
		<label><?php echo __('host');?></label>
	    <?php echo $form->textField($model, 'host');?>
		<label><?php echo __('host_db');?></label>
	    <?php echo $form->textField($model, 'host_db');?>
		<label><?php echo __('host_user');?></label>
	    <?php echo $form->textField($model, 'host_user');?>
		<label><?php echo __('host_pwd');?></label>
	    <?php echo $form->textField($model, 'host_pwd');?>
	 </fieldset>
 </div>
 <div class="col-lg-6">
	 	<fieldset >
		    <legend>Suppuer User Account </legend>
			<label><?php echo __('username');?></label>
			<?php echo $form->textField($model, 'username');?>
			<label><?php echo __('email');?></label>
		    <?php echo $form->textField($model, 'email');?>
			<label><?php echo __('password');?></label>
		    <?php echo $form->textField($model, 'password');?>  
	  </fieldset>
  </div>
<div style="clear:both;padding-top:20px;margin-left:13px;"> 
	<?php echo CHtml::submitButton(__('install'), array('class' => 'btn btn-default')); ?>
 
</div> 
<?php $this->endWidget(); ?>
</div>
	
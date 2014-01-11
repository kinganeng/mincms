<?php
 
?>
<blockquote>
	<h3>
		<?php echo $model->email;?>  
	 
	</h3>
</blockquote>
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'user-form', 
	'htmlOptions' => array('class' => 'form-horizontal'),
)); ?> 

 
<p>
<input type='hidden' name='hidden' value=1>
<label class="label <?php if($self==1){?> label-info <?php }?>">
	<input type='checkbox' name='self' value=1 
		<?php if($self==1){?>
			checked='checked' 
		<?php }?>
		>
	
</label>
<?php echo __('myself');?>
</p>
<?php echo CHtml::dropDownList('group[]',$groups,$rows,array('multiple'=>'multiple','style'=>'width:300px;'));?>
 
	<div class="controls margin-top">
		<?php echo CHtml::submitButton(__('save'), array('class' => 'btn')); ?>
	</div>
<?php $this->endWidget(); ?>
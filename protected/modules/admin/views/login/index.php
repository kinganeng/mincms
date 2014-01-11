 <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4"><div class="panel panel-default" style="margin-top:150px;">
		  <div class="panel-heading"><?php echo __('admin login'); ?></div>
		  <div class="panel-body">
		   		<div class="form">
					<?php $form=$this->beginWidget('ActiveForm', array(
						'id'=>'login-form',
					 
					)); ?> 
						<div class="form-group">
							<?php echo $form->labelEx($model,'username'); ?>
							<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'username'); ?>
						</div>

						<div class="form-group">
							<?php echo $form->labelEx($model,'password'); ?>
							<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
							<?php echo $form->error($model,'password'); ?>
						 
						</div>
					 
						<div class="form-group buttons">
							<?php echo CHtml::submitButton(__('login'),array('class'=>'btn btn-primary')); ?>
						</div>

					<?php $this->endWidget(); ?>
					</div><!-- form -->

		  </div>
		</div>
		 </div>
        <div class="col-md-4"> </div> 
     </div>

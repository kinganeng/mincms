<div class="form">
<?php 
//多语言判断	
if(true === $multiLanguage && $model->id>0){?>
	<div class="nav  navbar-right">
		<?php 
		foreach(cache('defaultDBLangugeAll') as $k=>$v){
		$flag = false;
		if($model->language_id == $k) $flag = true;
		?>
		<span class="label <?php if(true === $flag){?>label-danger
			<?php }else{?>
			label-default <?php }?>" style="margin-right:5px;">
				
			<?php foreach($muitLang as $lanId=>$dbId){ 
				if($lanId == $k ){
					if(!$flag)
						echo CHtml::link($v,url($editUrl,array('id'=>$dbId)));
					else
						echo $v;
				}	
			}?>
		 
		</span>	
		<?php }?>
		
	</div>
<?php }?>
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'node',
	'enableAjaxValidation'=>false,
)); ?> 
	<?php if($error) echo $form->errorSummary($model); ?>  
	
	<?php foreach($row as $k=>$v){
	$output = Helper::builder( array('form'=>$form,'model'=>$model,'name'=>$k,'v'=>$v));
	if(!$output) continue;
	?>
		<div class="form-group">
			<?php if($v['label']){?>
				<label><?php echo __($v['label']);?></label>
			<?php }else{?>
				<?php echo $form->labelEx($model,$k); ?> 
			<?php }?>
			<?php echo $output; ?>
			<?php if(!$error) echo $form->error($model,$k); ?>
		</div> 
 	<?php }?>
	 

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? __('create') : __('save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
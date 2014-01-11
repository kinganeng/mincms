<blockquote>
	<h3>
		<?php echo $model->name;?>  
		<small><?php echo __('bind access'); ?></small>
	</h3>
</blockquote>
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'user-form', 
)); ?> <table class="table table-bordered" id='acl'>
  <thead>
    <tr>
      <th width="100px"><?php echo __('module alias');?></th>
      <th><?php echo __('action name');?></th> 
    </tr>
  </thead>
  <tbody>
    <?php foreach($rows as $k=>$v){ $d = $out[$k];?>
	    <tr>
	      <td><?php echo $d['name'];?></td>
	      <td>
	        <?php if($v){
	        	foreach($v as $_k=>$_v){ $value = $out[$_k]; ?>
	        	<label class="label hander <?php if($access && in_array($_k,$access)){?> label-info <?php }?>">
	        		<input type='checkbox' name='auth[]' value="<?php echo $_k;?>" 
		        		<?php if($access && in_array($_k,$access)){?>
		        			checked='checked' 
		        		<?php }?>
	        			>
	        		<?php echo $value['name'];?>
	        	</label>
	        <?php }}?> 
	      </td>
	       
	    </tr>
    <?php }?>
  </tbody>
</table>
	<div class="controls margin-top">
		<?php echo CHtml::submitButton(__('save access'),  array('class' => 'btn')); ?>
	</div>
<?php $this->endWidget(); ?>
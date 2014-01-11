<?php
 
?>
<blockquote>
	<h3><?php echo __('translate');?></h3>
</blockquote>
<hr>
<div class="row-fluid">
<div class='col-lg-4'>
<?php foreach($dirs as $d){?>	
<blockquote>
	<h6><span class="label label-primary"><?php echo __($d);?></span></h6>
	<?php $list = $dir[$d];
	if($list){
		foreach($list as $li){?>
			<small><a href="<?php echo url('i18n/default/index',array(
				'id'=>$li,'name'=>$d
				));?>"><?php echo $li;?></a></small>
	<?php }}?>
</blockquote>
<?php }?>
</div>
 
<?php if($id){?>
<div class='col-lg-8'>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
	)); ?> 
 
	<blockquote>
		<h6><?php echo __('translate file');?></h6>
		<small><?php echo $name.' / '.$id;?> </small>
		<?php 
		unset($d);
		foreach( $dirs as $a){
			$d[$a] = __($a);
		}
		$dirs = $d;
		echo CHtml::dropDownList('lan',$name,$dirs);?>
		<?php echo CHtml::submitButton(__('save'),  array('class' => 'btn btn-success','style'=>'
		float: right;
width: 100px;
height: 90px;
position: relative;
top: -66px;
	')); ?>
	</blockquote> 
	 
	
 
	<i class="glyphicon glyphicon-plus hander add"></i>
	 
	<?php if($content){?>
		<?php foreach($content as $k=>$v){ if(!$k) continue;?>
			<p class='well'> <i class="icon-trash hander remove" style="float:right;"></i>
				<input name="key[]" class="input-large" value="<?php echo $k;?>" style='width:80%;margin-bottom:5px;'> 
				<textarea name="value[]" class="input-large" style='width:80%'> <?php echo $v;?> </textarea>
			</p>
		<?php }?>
	<?php }?>
	
	<?php $this->endWidget(); ?>

</div>
<?php }?>
</div>
<?php 
js_code('i18n_js',"
$('.add').click(function(){
	$('p:first').before('<p class=\'well\'>'+$('p:first').html()+'</p>');
	$('p:first').find('input').val('');
	$('p:first').find('textarea').val('');
	module_i18n_remove(); 
});
module_i18n_remove();
function module_i18n_remove(){
	$('.remove').click(function(){
		$(this).parent('p').remove();
	});
}
");
?>
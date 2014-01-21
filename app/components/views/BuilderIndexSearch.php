<div class='well '>
<?php $searchForm=$this->beginWidget('CActiveForm', array(
 	'action'=>$indexUrl,
	'method'=>'GET',
	 
)); ?>

	<?php foreach($row as $k=>$v){
	 	if($v['search'] === true){
	?>
		<div class="form-group">
			<label><?php echo __($k); ?> </label>
			<?php echo Helper::builder( array('form'=>$searchForm,'model'=>$model,'name'=>$k,'v'=>$v)); ?> 
		</div> 
 	<?php }}?>

	 

	<div class="form-group  ">
		<?php echo CHtml::submitButton(__('search'),array('class'=>'btn btn-primary')); ?>
		<a href="<?php echo url($indexUrl);?>" class="btn btn-success" >
			<?php echo  __('clean'); ?>
		</a>
	</div>

<?php $this->endWidget(); ?>
</div>
 
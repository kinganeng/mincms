<?php
 
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;
$this->breadcrumbs=array(
	__('album')=>url('album/default/index'),
	"[".$row['name']."]",
);
core_js('jquery');
core_js('jquery.ui'); 
/*widget('masonry' , array(
	'tag'=>'#masonry',
	'scroll'=>true, 
));*/
UiHelper::sort('#sortable',url('album/image/sort'),'ul');
css_code("
#sortable ul{margin:0;padding:0;}
#sortable li{ list-style:none; float:left;margin-right:5px; margin-bottom:5px;}
");
?> 
<blockquote><h3><?php echo $row['name'];?></h3></blockquote>
<div class='well'>
<?php $this->beginWidget('ActiveForm', array( 
	'enableAjaxValidation'=>false,
)); ?>  
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<div class="form-group">
		<?php echo CHtml::submitButton( __('save'),array('class'=>'btn btn-primary')); ?>
	</div>
	<?php echo widget('plupload');?>
	
	
<?php $this->endWidget(); ?>
</div>		
		
<div style='clear:both;'></div>
<?php $this->beginWidget('ActiveForm', array( 
	'enableAjaxValidation'=>false, 
	'id'=>'sortable',
)); ?> 
<div id='masonry'>
<ul >
	<?php if($pager->posts){ foreach($pager->posts as $v){?>
			<?php $f = FileHelper::attachment($v['fid']);
				
			?> 
	 		 <li class='item'> 
	 		 	<input type='hidden' name="ids[]" value="<?php echo $v['id'];?>" >
	  			<img src="<?php echo image_url($f['fullpath'],array('resize'=>array(160,120)));?>" />
	  		</li>  
	<?php }}?>
 </ul>	
</div>
<?php $this->endWidget(); ?>	
<div style="clear:both;"></div>			 
<?php $this->widget('LinkPager',array('pages'=>$pager->pages));?>
 
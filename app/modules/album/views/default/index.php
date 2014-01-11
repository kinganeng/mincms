<?php
 
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;
$this->breadcrumbs=array(
	__('album'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<?php $form=$this->beginWidget('CActiveForm',array('id'=>'sort')); ?> 
	<?php  
	UiHelper::sort('#sort',url('album/default/sort')); 
	$this->widget('BuilderIndex',array(
		'config'=>'application.modules.album.config.albums',
		'function'=>array( 
			'order'=>"sort desc,id desc",
		),
		'action'=>array(
			'<span class="glyphicon glyphicon-camera"></span>'=>'album/image/index',
		),
		
	));?>

<?php $this->endWidget(); ?>
 
<?php
 
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;
$this->breadcrumbs=array(
	__('menu'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>
<blockquote><?php echo __('admin menu');?></blockquote>
<?php  
	UiHelper::sort('#sort',url('menu/default/sort')); 
	$this->widget('BuilderIndex',array(
		'config'=>'application.modules.menu.config.menus',
		'function'=>array(
			'where'=>"pid=".$pid." and is_admin=1",
			'order'=>"sort desc,id desc",
		),
		'uisort'=>true,
		
));?>


<blockquote><?php echo __('front menu');?></blockquote>
	
<?php  
	UiHelper::sort('#sort2',url('menu/default/sort')); 
	$this->widget('BuilderIndex',array(
		'config'=>'application.modules.menu.config.menus',
		'function'=>array(
			'where'=>"pid=".$pid." and is_admin=0",
			'order'=>"sort desc,id desc",
		),
		'uisort'=>true,
		'sortId'=>'sort2',
));?>

 
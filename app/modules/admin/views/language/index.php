<?php
$pid = (int)$_GET['pid']>0?(int)$_GET['pid']:0;


$this->breadcrumbs=array(
	__('language'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);
?>

<p><span class="label label-info"><?php echo __('default language');?>:</span>
	<span class="label label-default">
		<?php echo $name;?>
	</span>
</p>
<?php  $this->widget('BuilderIndex',array(
	'config'=>'application.modules.admin.config.languages',
	'function'=>array(
	 	
	),
	'uisort'=>true
));?>
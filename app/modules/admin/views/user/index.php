<?php
$this->breadcrumbs=array(
	__('user')=>array('index'),
	__('manage'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>array('index')),
	array('label'=>__('create'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo __('manage');?></h1> 
<?php echo CHtml::link(__('<span class="glyphicon glyphicon-search"></span>'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('GridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username', 
		'mygroup',
		array(
			'class'=>'CButtonColumn',  
			'template'=>'{update}  {delete}  {bind}',
			'buttons'=>array(
			'bind' => array(
				    'label'=>'<span class="glyphicon glyphicon-wrench"></span>',  
				    'url'=>'url("admin/group/bind",array("id"=>$data->id))', 
				),
			)
		),
	),
)); ?>

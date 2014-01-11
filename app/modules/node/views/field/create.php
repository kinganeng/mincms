<?php
$this->breadcrumbs=array(
	__('content type'),
);
$this->menu=array(
	array('label'=>__('manage'), 'url'=>url('node/field/index',array('id'=>$id))),
	array('label'=>__('create'), 'url'=>url('node/field/create',array('id'=>$id))),
); 
?>
<blockquote><?php echo $cont->name;?></blockquote>
<?php $form=$this->beginWidget('ActiveForm', array( 
	'enableAjaxValidation'=>false,
)); ?> 
	<?php  echo $form->errorSummary($model); ?>  
	<div class="form-group">
		<label><?php echo __('label');?></label>
	 	<?php echo $form->textField($model,'label',array('class'=>'form-control')); ?>
 	</div> 
	<div class="form-group">
		<label><?php echo __('field_name'); if($model->id) $readonly = true; ?></label>
	 	<?php echo $form->textField($model,'name',array('class'=>'form-control','readonly'=>$readonly)); ?>
 	</div> 
 	
 	 
 	
		
	<div class="form-group">
		<?php echo $form->labelEx($model,'widget'); ?> 
	 	<?php echo $form->textArea($model,'widget',array('class'=>'form-control')); ?>
 	</div> 
		
	<div class="form-group">
		<?php echo $form->labelEx($model,'type'); ?> 
	 	<?php echo $form->dropDownList($model,'type',$type); ?>
 	</div> 
	<div id='ajax' class='form-group'>
	
	</div>	
	<div class="form-group">
		<?php echo $form->labelEx($model,'value'); ?> 
	 	<?php echo $form->textArea($model,'value',array('class'=>'form-control')); ?>
 	</div> 	
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'rules'); ?> 
	 	<?php echo $form->textArea($model,'rules',array('class'=>'form-control')); ?>
 	</div>  
 	<div class="form-group">
		<label><?php echo __('default_value');?></label>
	 	<?php echo $form->textField($model,'default_value',array('class'=>'form-control')); ?>
 	</div>
 	<div class="form-group">
		<label><?php echo __('memo');?></label>
	 	<?php echo $form->textField($model,'memo',array('class'=>'form-control')); ?>
 	</div>		
 	<div class="form-group">
		<label><?php echo __('mvalue'); if($model->id) $display = array('disabled'=>true);?></label>
	 	<?php echo $form->dropDownList($model,'mvalue',array(1=>__('yes'),0=>__('no')),$display); ?>
 	</div>	 
	<div class="form-group">
		<?php echo $form->labelEx($model,'search'); ?> 
		<?php echo $form->dropDownList($model,'search',array(1=>__('yes'),0=>__('no'))); ?>
  	</div>
 		
 	<div class="form-group">
		<?php echo $form->labelEx($model,'indexes'); ?> 
		
	 	<?php echo $form->dropDownList($model,'indexes',array(1=>__('yes'),0=>__('no'))); ?>
 	</div>
	
	<div class="form-group">
		<label><?php echo __('mysql_ext');if($model->id) $readonly = true;?></label>
	 	<?php echo $form->textField($model,'mysql_ext',array('class'=>'form-control','readonly'=>$readonly)); ?>
	 	<div class="alert alert-info">MYSQL生成表，可为空。如varchar(200)</div>
	 	
 	</div>	
 	<div class="form-group">
		<label><?php echo __('automodel');?></label>
	 	<?php echo $form->textArea($model,'automodel',array('class'=>'form-control')); ?>
	 	<div class="alert alert-info">暂不支持</div>
 	</div>
		
		
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? __('create') : __('save'),array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
	
<?php
/**
* 字段类型 使用AJAX
* 数据库表名及字段名
*/
$rows = CDB('SHOW TABLES')->queryAll();
foreach($rows as $v){
	$mysql_table = ArrHelper::first($v);
	if(in_array($mysql_table,array('node_field','node_content'))) continue;
	$row = CDB("SHOW  COLUMNS FROM  $mysql_table")->queryAll();
	foreach($row as $k){
		$f = $k['Field'];
		if(!in_array($f,array('uid','created','id','updated','language_id','vid','sort','display')) && strpos($f,'id')===false){
			$ajax_str .= "'".$mysql_table.'.'.$f."',";
		}
	}
	 
}
$ajax_str = substr($ajax_str,0,-1);
/**
* ajax 自动完成的验证规则
*/
$ruels_default = "'required:1','length: min:3 max:12'";
 
js_code("
	function init_type(v){ 
		$.post('".url('node/field/ajax')."',{id:v},function(data){ 
			$('#ajax').html(data);
			jQuery('#NodeField_relation').autocomplete({'minLength':'1','source':[".$ajax_str."]});
			
		});
	}
	init_type($('#NodeField_type').val());
	$('#NodeField_type').change(function(){ 
		init_type( $(this).val() );
	});
	jQuery('#NodeField_rules').autocomplete({'minLength':'1','source':[".$ruels_default."]});
");
core_js('jquery.ui');
 
$cssCoreUrl = Yii::app()->getClientScript()->getCoreScriptUrl(); 
css($cssCoreUrl . '/jui/css/base/jquery-ui.css'); 


 
 
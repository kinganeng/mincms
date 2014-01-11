<?php
/**
* albums 表配置
*/
return array(
	'name'=>array( 
		'type'=>'input', 
		'index'=>true,
	),
	'body'=>array( 
		'type'=>'text', 
		'widget'=>array(
			'ckeditor'=>array(
				'tag'=>'AutoModel_body'
			)
		),
		 
	),
	//验证规则
	'_rules'=>array(
		array('name', 'application.components.validate.unique','table'=>'albums'),
	    array('name', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	
);
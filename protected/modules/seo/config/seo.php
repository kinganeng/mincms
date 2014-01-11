<?php
/**
* language 表配置
*/
return array(
	'keywords'=>array( 
		'type'=>'input', 
		'index'=>true,
	),
	'description'=>array( 
		'type'=>'input',
		'index'=>true,	
	),
	'url'=>array( 
		'type'=>'input',
		'index'=>true,	
	),
	//验证规则
	'_rules'=>array( 
	    array('keywords,description', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	
);
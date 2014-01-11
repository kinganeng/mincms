<?php
class Module_Node_Config{ 
	static function  name($v){   
		return "<input type='hidden' value='".$v['id']."' name='ids[]'>".$v['name'];
	}
}
return array(
	
	'discription'=>array( 
		'label'=>'name',
		'type'=>'input', 
		'index'=>true, 
	),
	'name'=>array( 
		'type'=>'input', 
		'label'=>'field_name',
		'index'=>true, 
		'_value'=>'php:Module_Node_Config::name',
	),
	//验证规则
	'_rules'=>array( 
		array('name', 'application.components.validate.unique','table'=>'node_content'),
	    array('name', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	
);
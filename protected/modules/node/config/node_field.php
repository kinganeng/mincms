<?php
class Module_Node_Field{ 
	 
	static function  name($v){   
		return "<input type='hidden' value='".$v['id']."' name='ids[]'>".$v['name'];
	}
} 

return array(
	'node_content_id'=>array( 
		'type'=>'input',  
		'_value'=>'php:Module_Node_Field::name',
	), 
	'name'=>array( 
		'type'=>'input', 
		'index'=>true,
		'_value'=>'php:Module_Node_Field::name',
 	),  
	'widget'=>array( 
		'type'=>'checkbox',  
	),
	'type'=>array( 
		'type'=>'checkbox', 
		'index'=>true,	
	),
	'search'=>array( 
		'type'=>'select',  
		'datas'=>array(
	        ""=>__('please select'),
			1=>__('yes'),
			0=>__('no'),
		),	
	),
	'indexes'=>array( 
		'type'=>'checkbox',  
	), 
	//验证规则
	'_rules'=>array(
		array('name', 'application.components.validate.unique','table'=>'node_field'),
	    array('name,node_content_id', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
 
);
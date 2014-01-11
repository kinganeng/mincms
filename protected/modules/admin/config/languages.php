<?php
/**
* language 表配置
*/
class Module_Config_Language{
	static function de($v){
		$s = '<span class="glyphicon glyphicon-ok"></span>';
		$t = "<input type='hidden' value='".$v['id']."' name='ids[]'>".$v['name'];
		if($v['is_default']==1)
			return $t.$s;
		return $t;
	}
}
return array(
	'name'=>array( 
		'type'=>'input', 
		'index'=>true,
		'_value'=>"php:Module_Config_Language::de",
	),
	'code'=>array( 
		'type'=>'input', 
		'index'=>true,	
	),
	'is_default'=>array( 
		'type'=>'checkbox',  
	),
	//验证规则
	'_rules'=>array(
		array('code', 'application.components.validate.unique','table'=>'languages'),
	    array('name,code', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	'_AutoModel'=>array(
		'Clean'	
	),
);
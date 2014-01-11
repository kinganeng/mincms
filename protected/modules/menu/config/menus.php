<?php
/**
* language 表配置
*/
$db = Yii::app()->db->createCommand();
$db->setFetchMode(PDO::FETCH_OBJ);
$rows = $db 
		->from('menus') 
		->queryAll();

if($rows){ 
	foreach($rows as $v){  
		$v->name = __($v->name);
		$tree[$v->id] = $v; 
	}   
	$arr = ArrHelper::tree($tree);
}
 
$arr[0] = __('please select');
/**
* 菜单 默认第一个显示PID为0的，
* 一层层向下，直到没有下层，将不显示超链接，直接显示字段name的值
*/
function menu_config_name($v){
	$row = Yii::app()->db->createCommand()->from('menus')->where("pid=:pid",array(':pid'=>$v['id']))->queryRow(); 
	if($row)
		$out = "<a href='".url('menu/default/index',array('pid'=>$v['id']))."'>".__($v['name'])."</a>";
	else
		$out =  __($v['name']);
	
	return "<input type='hidden' value='".$v['id']."' name='ids[]'>".$out;
}
function menu_config_admin($v){
	if($v['is_admin']==1)
		return '<span class="glyphicon glyphicon-ok"></span>';
	return "";
}
return array(
	'name'=>array( 
		'type'=>'input', 
		'index'=>true,
		'_value'=>"php:menu_config_name"
	
	),
	'pid'=>array( 
		'type'=>'select',
		'datas'=>$arr, 
	),
	'url'=>array( 
		'type'=>'input',
		 
	),
	'is_admin'=>array( 
		'type'=>'select',
		'datas'=>array(
			'0'=>__('no'),
			'1'=>__('yes'), 
		),  
		'_value'=>"php:menu_config_admin"
	),
	//验证规则
	'_rules'=>array( 
	    array('name,url', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	
);
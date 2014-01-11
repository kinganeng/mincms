<?php
/**
* language 表配置
*/
$db = Yii::app()->db->createCommand();
$db->setFetchMode(PDO::FETCH_OBJ);
$rows = $db 
		->from('category') 
		->queryAll();

if($rows){ 
	foreach($rows as $v){  
		$tree[$v->id] = $v; 
	}   
	$arr = ArrHelper::tree($tree);
}
 
$arr[0] = __('please select');
/**
* 分类 默认第一个显示PID为0的，
* 一层层向下，直到没有下层，将不显示超链接，直接显示字段name的值
*/
function admin_config_category($v){
	$row = Yii::app()->db->createCommand()->from('category')->where("pid=:pid",array(':pid'=>$v['id']))->queryRow(); 
	if($row)
		return "<a href='".url('admin/category/index',array('pid'=>$v['id']))."'>".$v['name']."</a>";
	return $v['name'];
}
return array(
	'name'=>array( 
		'type'=>'input', 
		'index'=>true,
		'_value'=>"php:admin_config_category"
	),
	'pid'=>array( 
		'type'=>'select',
		'datas'=>$arr, 
	),
	//验证规则
	'_rules'=>array( 
	    array('name', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	
);
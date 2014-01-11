<?php
// +----------------------------------------------------------------------
// | 对自动生成的表field_{name} 生成配置文件 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
$fid = (int)$_GET['fid'];
$model = NodeContent::model()->findByPk($fid);
/**
* 取得分类
*/
class Module_Node_Query{
	static function category(){
		$db = Yii::app()->db->createCommand();
		$db->setFetchMode(PDO::FETCH_OBJ);
		$rows = $db 
				->from('category') 
				->queryAll(); 
		if($rows){ 
			foreach($rows as $v){  
				$tree[$v->id] = $v; 
			}   
			$category = ArrHelper::tree($tree);
		}
		return array($category,$tree);
	}
	
	/**
	* 语言
	*/
	static function language(){
		$rows = Yii::app()->db->createCommand() 
				->from('languages') 
				->queryAll();
		$language = array();
		if($rows){
			foreach($rows as $v){
				$language[$v['id']] = $v['name'];
			}
		}
		return $language;
	} 
	static function  name($v){   
		return "<input type='hidden' value='".$v['id']."' name='ids[]'>".$v['title'];
	}
}
$categoryAll = Module_Node_Query::category();
$category = $categoryAll[0];
$category[""] = __('please select'); 
  
$language = Module_Node_Query::language();
$language[""] = __('please select'); 

/**
* 列表中显示对应分类的名称
*/
function node_config_cateogry($v){
	$id = $v['category_id'];
	$categoryAll = Module_Node_Query::category();
	$category = $categoryAll[1];
	$v = $category[$id]; 
	return $v->name;
}
/**
* 语言
*/
global $global_field_table;
$global_field_table = "field_".$model->name;
function node_config_language($v){
	global $global_field_table;
	$id = $v['language_id']; 
	$str = LanguageHelper::img($global_field_table,$v['vid'] ,array('node/query/update',array('id'=>'{id}','fid'=>(int)$_GET['fid'])));
	return  $str;
}



$fields = $model->fields;
$rules = array();
$i = 0;
foreach($fields as $v){  
	$name = $v->name;
	$search = false;
	if($v->search==1) $search = true;
	$indexes = false;
	if($v->indexes==1) $indexes = true;
	$arr[$v->name]['label'] = $v->label;
	$arr[$v->name]['type'] = $v->type;
	$arr[$v->name]['index'] = $indexes?:false;
	$arr[$v->name]['search'] = $search?:false;
	//单个Node_Field的具体信息
	$arr[$v->name]['model'] = $v;
//	$arr[$v->name]['datas'] = $v->search; 
	//当前的值
	$arr[$v->name]['_value'] = 4;
	//是否保存到关联表
	if($v->relation && $v->mvalue==1){
		$arr[$v->name]['_relation_table'] = true;
		$relation_table[$v->name] = "field_".$model->name.'_'.$v->name;
		$arr[$v->name]['insert'] = false;
	}
	$r = $v->_rules;
 
	if($r){ 
		
		foreach($r as $_k=>$_v){
			$rules[$i][] = $v->name;
			if(!is_array($_v) && is_bool($_v))
				$rules[$i][] = $_k;
			else{
				$rules[$i][] = $_k;
				foreach($_v as $key=>$vo){
					$rules[$i][$key] = $vo;
				}
			}
			
		}
	}
	$i++;
} 


$arr['language_id']=array( 
		'type'=>'select',
		'datas'=>$language,
		'index'=>true,	
		'search'=>true,
		'_value'=>"php:node_config_language"
);
		
$arr['_error'] = 1;
$arr['_rules'] = $rules;
//是否是数据库多语言
$arr['_multiLanguage'] = true;
/**
* 关联表的信息， 数组key为字段名，值为完整表名
*/
$arr['_relation_table'] = $relation_table;

 
//模块
$arr['_AutoModel'] = array(
		'AdminUid'	,'Time','Vid','Uuid'
);
//dump($arr);
return $arr;
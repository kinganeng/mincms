<?php
// +----------------------------------------------------------------------
// | NODE 快速查寻保存
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
 
class Node{ 
 
	 
	static function find($table,$id){
		 //所以字段key以及对应的model
		 $cache = cache('node__field_table');
		 $now = $cache[$table];
		 $table = "field_".$table;
		 $row = CDB()->from($table)->where('id=:id',array(':id'=>$id))->queryRow();
		 
		 //没有缓存是有问题的
		 if(!$cache) { 
		 	return $row;
		 } 
		 foreach($now as $k=>$v){
		 	$name = trim($v->name);
 			$_relation_table = $table."_".$name;
 			//真实的第三方表的内容
 			$deep = $v->_relation_table; 
		 	//是多个值的，并且是关联其他表的情况
		 	if($v->relation && $v->mvalue==1){  
					$allR = CDB()->from($_relation_table)->where('nid=:nid',array(':nid'=>$id))->queryAll();
					if($allR){
						foreach($allR as $key=>$al){ 
							$value = $al['value'];
							$values = CDB()->from($deep)->where('id=:id',array(':id'=>$value))->queryRow();
							$all[$name][$value] = $values;
						} 
					}
					foreach($all as $key=>$value){
						$row[$key] = $value;
					}
			}else if($v->relation){
				$value = CDB()->from($deep)->where('id=:id',array(':id'=>$row[$name]))->queryRow();
				$row[$name] = $value;
			}
		 }
		 
		 return $row;
	}
		 
		 
 
	
}
/**
* HOOK 缓存内容类型字段的结构
*/
Hook::init('init[].node_content',function(){
	if(!cache('node__field_table')){
		Yii::import("application.modules.node.models.NodeContent");
		Yii::import("application.modules.node.models.NodeField");
		$rows = NodeContent::model()->findAll(); 
		if($rows){
			foreach($rows as $v){
				$data[$v->id] = $v->name;
				$id = $v->id;
				foreach($v->fields as $f){
					$field[$id]['id'] = $f->id;
					$field[$id]['name'] = $f->name;
					$field[$id]['type'] = $f->type;
					$field[$id]['widget'] = $f->widget;
					
					$field_table[$v->name][$f->name] = $f;
					
				}
			} 
			cache('node__content',$data); 
			cache('node__field',$field);
			cache('node__field_table',$field_table);
		}
	} 
});	

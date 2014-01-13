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
 	/**
	*
	$criteria =  new CDbCriteria();
	$criteria->condition = "id = 1 or id =1";
	$row = Node::pager('post',$criteria);
	$pages = $row['pages'];
	$posts = $row['posts'];
	$this->widget('LinkPager',array('pages'=>$pages));
	*/
	static function pager($table,$criteria,$pageSize = 10){
		  return static::find($table,$criteria,$pager = true,$pageSize); 
	}
	/**
	* 
	$criteria =  new CDbCriteria();
	$criteria->condition = "id = 1 or id =1";
	$node = Node::find('post',$criteria); 
	Node::find('post',1); 
	*/
	static function find($table,$criteria,$pager = false,$pageSize = 10){
		 //所以字段key以及对应的model
		 $cache = cache('node__field_table');
		 $now = $cache[$table];
		 $realTable = "field_".$table; 
		 if(!is_object($criteria)) $id = $criteria;  
		 //设置NodeModel的表名
		 NodeModel::$_table = $realTable; 
		 if(is_object($criteria)) { 
		 	if(true === $pager){
			 	$count = NodeModel::model()->count($criteria);     
			 	$pages    =  new CPagination($count); 
			    $pages->pageSize = $pageSize ;  
			    $pages->applyLimit($criteria); 
		    }
		    $posts = NodeModel::model()->findAll($criteria); 
		 	if(!$posts) return null;
		 	foreach($posts as $r){  
		 		$allRows[$r->id] = static::find($table,$r->id); 
		 	}
		 	if(true === $pager) 
		 		return array('posts'=>$allRows,'pages'=>$pages);
		 	return $allRows;
		 }   
		 $fields = cache('node__content_field'); 
		 if(!fields) return null;  
		 $rows = NodeModel::model()->findByPk($id);  
		 foreach($fields[$table] as $k=>$v){  
		 	$row[$k] = $rows->$k;
		 } 
		 //没有缓存是有问题的
		 if(!$cache) { 
		 	return $row;
		 }  
		 foreach($now as $k=>$v){
		 	$name = trim($v->name);
 			$_relation_table = $realTable."_".$name;
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
						foreach($all as $key=>$value){
							$row[$key] = $value;
						}
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
	if(!cache('node__content_field')){
		Yii::import("application.modules.node.models.NodeContent");
		Yii::import("application.modules.node.models.NodeField");
		$rows = NodeContent::model()->findAll(); 
		if($rows){
			foreach($rows as $v){
				$data[$v->id] = $v->name;
				$id = $v->id;
				unset($d);
				
				foreach($v->fields as $f){
					$field[$id]['id'] = $f->id;
					$field[$id]['name'] = $f->name;
					$field[$id]['type'] = $f->type;
					$field[$id]['widget'] = $f->widget; 
					$field_table[$v->name][$f->name] = $f; 
					$d[$v->name]['id'] = 'id';
					$d[$v->name]['vid'] = 'vid';
					$d[$v->name]['display'] = 'display';
					$d[$v->name]['uid'] = 'uid';
					$d[$v->name]['uuid'] = 'uuid';
					$d[$v->name]['language_id'] = 'language_id';
					$d[$v->name]['created'] = 'created';
					$d[$v->name]['updated'] = 'updated';
					$d[$v->name][$f->name] = $f->name;
				}
			} 
			cache('node__content',$data); 
			cache('node__field',$field);
			cache('node__content_field',$d);
			cache('node__field_table',$field_table);
		}
	} 
});	

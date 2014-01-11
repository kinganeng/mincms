<?php 
// +----------------------------------------------------------------------
// | 数组
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class ArrHelper
{ 
	static $_tree;
	static $_ptree;
	static $_i = 0;
	static $_j = 0;
	static $tree; 
 	static $deep = 0; 
 	
 	static function first($arr){
 		if(!is_array($arr)) return;
		foreach($arr as $ar){
			return $ar;
		}
	}
	static function limit($arr , $limit = 1){
		$i = 0;
		foreach($arr as $ar){
			if($i< $limit){
				$array[] = $ar;
			}
			$i++;
		}
		return $array;
	}
	/**
	* 数组键相同时，值相加
	*/
	static function valueadd($a, $b){
	   if (is_array($a) && is_array($b)){ 
	    	foreach ($a as $k=>$v) { 
	    		if($k && $b[$k]){
	  				$arr[$k] = $v + $b[$k];
	     		} else {
	      			$arr[$k] = $v;
	     		}
	    	}
	    	return $arr+$b;
	   	}  
	} 
	/**
	* 向下生成tree,返回的是数组 
	* 给select框使用
	
	$all = \application\modules\auth\models\Group::find()->all(); 
	$d = \application\core\Arr::tree($out);
	echo 'out:<br>';
	dump($d);
	*/
	static function model_tree($data=array(),$value='name',$id='id',$pid='pid',$root=0){   
		foreach($data as $v){ 
			$v = (object)$v;
			if($v->attributes)
				$out[$v->$id] = $v->attributes;
			else
				$out[$v->$id] = (array)$v;
		}  
		return static::tree($out,$value,$id,$pid,$root);  
	 
	}
	/**
	* 向下生成tree,返回的是数组 
	* 给select框使用
	
	$all = \application\modules\auth\models\Group::find()->all();
	foreach($all as $v){
		$out[$v->id] = $v->attributes;
	} 
	$d = \application\core\Arr::tree($out);
	echo 'out:<br>';
	dump($d);
	
	$all = Classes::all('taxonomy',array('orderBy'=>'sort desc,id desc'),true);   
 	foreach($all as $v){
		$taxonomy[$v->id] = $v;
	} 
	$all = \application\core\Arr::tree($taxonomy); 
	
	*/
	static function tree($data=array(),$value='name',$id='id',$pid='pid',$root=0){  
		self::$tree = array();
		$ids = self::_tree_id($data,$value,$id,$pid,$root);  
		$out = self::loop($data,$ids,$value);  
		return $out;
	}
	/**
	* 给tree方法使用。
	*/
	static function loop($data,$ids,$value,$j=0){   
		$span = "";  
		for($i=0;$i<$j;$i++){
			$span .= "|--"; 
		} 
		if(substr_count($span,'|')>1){
			$s = substr($span,strrpos($span,'|'));
			$span = str_replace("|--","&nbsp;&nbsp;",$span);
			$span = $span.$s;
		}
		$j++; 
		if(is_array($ids)){
			foreach($ids as $id=>$vo){  
				$vi = (array)$data[$id];
				self::$tree[$id] = $span . $vi[$value]; 
				self::loop($data,$vo,$value,$j); 
			}
			$j = 0; 
		}
		return self::$tree;
	}
	
	static function deep($arr = array()){
		foreach($arr as $v){
			self::$deep++;
			if(is_array($v))
				self::deep($v);
			return self::$deep;
		} 
		return self::$deep;
	}
	/**
	* 返回树状的id结构
	*/
	static function _tree_id($data=array(),$value='name',$id='id',$pid='pid',$root=0){ 
		foreach($data as $v){  
			$v = (object)$v; 
			if($v->$pid == $root){ 
				$s = self::_tree_id($data,$value,$id,$pid,$v->id);    
				$_tree[$v->$id] = $s;  
			} 
		}  
		return $_tree;
	}
	/**
	* 向上生成tree
	*/
	static function parentTree($data=array(),$parent=null,$root=0,$value='name',$id='id',$pid='pid'){
		self::$_j = 0;
		if(self::$_j == 0){
			self::$_ptree=array();
		}
		foreach($data as $v){ 
			$out[$v->$id] = $v->$value; 
		}  
		foreach($data as $v){
			if($v->$id == $parent &&  $v->$pid != $root){  
				self::$_j++;
			 	self::parentTree($data,$v->$pid,$root,$value,$id,$pid); 
				
			} 
		} 
		self::$_ptree[$parent] = $out[$parent];  
		return  self::$_ptree;
	}
	 
}
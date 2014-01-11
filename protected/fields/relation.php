<?php
// +----------------------------------------------------------------------
// | 表关联字段，当写入这个值的时候需要改动relation字段的值。格式为  
// | 关联的表名.关联的字段
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class relation{
	//CHtml 类型
	public $type = null;
	//是否创建字段
	public $create_field = false;
	
	/**
	* 对字段加载HOOK，改变relation 的值
	*/
	function view(){ 
		$str = "<label>".__('relation set').' '.__('format is').":[post.name]</label>";
	 	$str .= CHtml::textField('NodeField[relation]');
	 	echo $str; 
	}
	/**
	* 自动生成表单，使用SELECT
	* @parma  $name 字段名
	* @parma  $model 字段在Node_Field中的MODEL信息
	* @parma  $value 当前的值
	*/
	function action($name,$model,$value=null){  
	 	$r = $model->relation;
	 	$arr = explode('.',$r);
	 	$table = trim($arr[0]);
	 	$field = trim($arr[1]);
	 	$rows = CDB()->from($table)->queryAll();
	 	$data = array();
	 	if($rows){
		 	foreach($rows as $vo){
		 		$data[$vo['id']] = $vo[$field];
		 	}
	 	}
	  	$multiple  = $model->mvalue?true:false; 
	  	if(true === $multiple){
	  		$value = $_POST['Field'][$name];
			$str = CHtml::dropDownList("NodeField[$name]",$value,$data,array('multiple'=>$multiple));
		}else{ 
			$str = CHtml::dropDownList("AutoModel[$name]",$value,$data);
		}
	 	echo $str; 
		
	}
	
}
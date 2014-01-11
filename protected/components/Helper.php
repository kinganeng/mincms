<?php
// +----------------------------------------------------------------------
// | Helper  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class Helper
{ 
	static $name;
	
	/**
	* 配合BuilderView使用
	* 自动加载 application.fields下的字段类型
	*/
	static function builder($arr){
		//实例化的beginWidget('CActiveForm')
		$form = $arr['form'];
		//字段名
		$name = $arr['name'];
		$model = $arr['model'];
		$htmlOptions = array( 'class'=>'form-control' ); 
		//单个字段的详细配置
		$v = $arr['v'];
		//字段类型 对应application.fields下的文件名
		$type = $v['type'];
		$obj = new $type;
		$chtmlField = $obj->type;     
		if($v['widget']){
			foreach($v['widget'] as $k=>$vo){
				echo widget($k,$vo);
			}
		}
		if($type=='checkbox'){
			$htmlOptions = array( 'class'=>'checkbox' );  
		}
		if(!$chtmlField){
			return $obj->action($name,$v['model'],$model->$name);
		}
		if(array_key_exists('datas' , $v)){
			$values = $v['datas']; 
			$htmlOptions['encode'] = false;
			return $form->$chtmlField($model, $name ,$values, $htmlOptions); 
		}   
		return $form->$chtmlField($model, $name , $htmlOptions);
		
	}
 	static function set($name,$value){
 		self::$name[$name] = $value;
 	}

	static function get($name){
 		return self::$name[$name];
 	}	 
 	/** 
 	* 选中的菜单 
 	*/
 	static function activeMenu($name){
 		$name = str_replace('/','.',$name); 
 		if($name == self::get('activeMenu') || (is_array(self::get('activeMenu')) && in_array($name,self::get('activeMenu'))))
 			return true;
 		return false;
 	}
 	
 	
}

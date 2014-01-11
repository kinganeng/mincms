<?php
// +----------------------------------------------------------------------
// | ActiveRecord
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class ActiveRecord extends CActiveRecord{
	/*
 	* 属性自动翻译
 	*
 	*/
	public function attributeLabels()
	{  
		$class = new ReflectionClass($this);
		$names = array();
		foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
			$name = $property->getName();
			if (!$property->isStatic()) {
				$names[] = $name;
			}
		} 
		$names = array_merge($names,$this->getAttributes());  
		foreach($names as $v=>$k){
			$out[$v] = __($v);
		}  
		return $out;
	}
}
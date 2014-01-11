<?php 
// +----------------------------------------------------------------------
// | 配合BuilderView AutoModel 使用的验证规则   
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class Unique extends CValidator
{ 
	/**
	* 
	return array(
		'name'=>array( 
			'type'=>'input', 
		),
		'code'=>array( 
			'type'=>'input',	
		),
		//验证规则
		'_rules'=>array(
			array('name', 'application.components.validate.unique','table'=>'languages'),
		    array('name,code', 'required'), 
		),
		//是否顶部显示错误信息
		'_error'=>1,
		
	);
	*/
 	public $table;
 	protected function validateAttribute($object,$attribute)
    {
    	$value = $object->$attribute;
    	$flag = false;
    	$row = Yii::app()->db->createCommand()
    			->from(trim($this->table))
    			->where($attribute."=:".$attribute, array(':'.$attribute=>$value)) 
    			->queryRow(); 
     	 
    	if($row){
    		$flag = true;
    	} 
    	if($_GET['id']) {
    		$id = (int)$_GET['id']; 
    		if($row['id'] == $id)
    			$flag = false;
    	} 
        if($flag === true) {
    		$message=$this->message!==null?$this->message:Yii::t('yii','{attribute} "{value}" has already been taken.');
            $this->addError($object,$attribute,$message,array('{value}'=>CHtml::encode($value)));
        }
         
    }

 
 	
}

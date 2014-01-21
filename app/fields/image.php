<?php
// +----------------------------------------------------------------------
// | 文件
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class image{
	//CHtml 类型
	public $type = null;
	//是否创建字段
	public $create_field = false;
	
	/**
	* 对字段加载HOOK，改变relation 的值
	*/
	function hook(){
		Hook::init('model.NodeField_afterSave',function($model){
			CDB()->update('node_field',array('relation'=>"attachments.".$model->name),'id=:id',array(':id'=>$model->id));
			
		});
	}
	function action($name,$model,$v){ 
	 	if($v){
	 		if(is_array($v)){
	 			
	 		}else{
	 			$value = CDB()->from('attachments')->where('id=:id',array(':id'=>$v))->queryAll();
	 		}
	 	}
		$name = "AutoModel[$name]";
		
		echo widget('plupload',array('field'=>$name,'multi'=>false,'values'=>$value));
		
	}
	
}
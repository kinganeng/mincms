<?php 
// +----------------------------------------------------------------------
// | MODEL 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------


 
class GroupAccess extends \ActiveRecord 
{ 
	public  function tableName()
    {
        return 'group_access';
    } 
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
     
	public function rules()
	{ 
		return array(
			array('group_id, access_id', 'required'), 
		);
	} 
	/**
	* 返回access 里面name
	*/
	function access($access_id = null){
		$model = Access::model()->findAll();
		if(!$access_id) $access_id = $this->access_id;
		$t = \ArrHelper::parentTree($model,$access_id);
		unset($s);
		foreach($t as $v){
			$s .= $v.".";
		}
		return substr($s,0,-1); 
	}
	/**
	* 保存用户组对应的权限
	*/
	static function saveAccess($group_id,$access){
		GroupAccess::model()->deleteAllByAttributes(array('group_id'=>$group_id)); 
		foreach($access as $access_id){
			$model = new GroupAccess;
			$model->group_id = $group_id;
			$model->access_id = $access_id;
			$model->save();
		}
	} 
  
	 
 
	 
}
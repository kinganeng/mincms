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

 
class Group extends \ActiveRecord 
{
 
	public $old_pid;
 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'groups';
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new \CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('name',$this->name,true); 
		return new \CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 	 
	public function rules()
	{ 
		return array(
			array('slug, name, pid', 'required'),
			array('slug,name','unique'),  
			array('slug', 'match','pattern'=>'/^[a-z_]/', 'message'=>__('match')), 
		);
	}   
	/**
	* 一个组里面有多个权限
	*/
	 
	public function relations()
    {
        return array(
            'access'=>array(self::HAS_MANY, 'GroupAccess',  'group_id'), 
        );
    }
	 
   
	function dropDownList(){
		$first[0] = __('please select');
		$data = Group::model()->findAll();
		if($data){ 
			$out = \ArrHelper::model_tree($data);  
			$out = $first+$out; 
		}else{
			$out = $first;
		}
		return $out;
	}
	/**
	* 删除时，需要删除当前用户组 及 属于当前用户组的记录
	*/
	function getDelete_ids(){
		$data = Group::model()->findAll();
		if($data){
			$out = \ArrHelper::model_tree($data,$value='name',$id='id',$pid='pid',$this->id); 
		 	$out[$this->id] = $this->id;
		 	foreach($out as $k=>$v){
		 		$in[] = $k;
		 	}
		}else{
			$in[] = $this->id;
		}
		return $in;
	}
	function beforeDelete(){
		parent::beforeDelete();    
		if($this->delete_ids)
	 		Group::model()->deleteAll(array('id'=>$this->delete_ids)); 
	 	return true;
	}
	function afterFind(){
		parent::afterFind();
		$this->old_pid = $this->pid;
		return true;
	}
	/**
	* 保存数据前，对pid判断，是否是正确的移动
	* 如移到到自己及自己所属的子分类将提示移动失败
	* pid 值将不会被保存
	*/
	function beforeSave(){
		parent::beforeSave();
		if($this->id){ 
			$data = static::findAll();
			if($data){
				$out = ArrHelper::model_tree($data,$value='name',$id='id',$pid='pid',$this->id); 
			 	$out[$this->id] = $this->id;
			}else{
				$out[$this->id] = $this->id;
			}
			if($out[$this->pid]){
				$this->pid = $this->old_pid;
				flash('error',__('try change tree error'));
			}
		}   
	 
		return true;
	}
	/**
	* 显示 向上的树结构
	*/
	function getGroup_tree(){
		if(0 == $this->pid) return __('root');
		$data = Group::model()->findAll();  
		$out = ArrHelper::parentTree($data,$this->pid); 
	 	return implode("<br>",$out); 
	}
	
	/**
	* 绑定权限
	*/
	function getBindAccess(){
		return "<a href='".url('admin/auth/index',array('id'=>$this->id))."'>".__('bind access')."</a>";
	}
	 
}
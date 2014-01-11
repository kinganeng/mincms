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

 
class UserGroup extends \ActiveRecord 
{ 
	public function tableName()
    {
        return 'user_group';
    } 
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	} 
	public function rules()
	{ 
		return array(
			array('user_id, group_id', 'required'),
		);
	}  
    /**
    * 一个用户有多个组
    */ 
	public function relations()
    {
        return array(
            'access'=>array(self::HAS_MANY, 'GroupAccess', 'group_id'),
            /*'access'=>array(self::MANY_MANY, 'Access',
                'group_access(group_id, access_id)'),*/
            'g'=>array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }
	/**
	* 保存用户到用户组
	*/
	static function UserGroupSave($user_id,$group){ 
		\Yii::app()->db->createCommand()
		->update('users',
		array('yourself'=>$_POST['self']?1:0),
		'id=:id',array('id'=>$user_id)
		);
		if($group){
			UserGroup::model()->deleteAllByAttributes(array('user_id'=>$user_id)); 
			foreach($group as $group_id){
				$model = new UserGroup;
				$model->group_id = $group_id;
				$model->user_id = $user_id;
				$model->save();
			}
		}
	}
	
	 
     
}
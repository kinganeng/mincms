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

class User extends \ActiveRecord
{
	public $old_password;
	public $new_password;
	public $save_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}
	public function relations()
    {
        return array(
            'groups'=>array(self::HAS_MANY, 'UserGroup', 'user_id'), 
        );
    }
    function getMygroup(){
    	if($this->groups){
    		foreach($this->groups as $g){ 
    			$str[] = $g->g->name;
    		}
    		$str = implode(' | ',$str);
    	}
    	return $str;
    }
	function afterFind(){
		parent::afterFind();
		$this->save_password = $this->password;
	}
	function beforeSave(){
		parent::beforeSave();
		if($this->validate())
			$this->password = $this->hashPassword($this->password);
		return true;
	}
	/**
	* 生成权限列表
	*/
	static function access($id){
		if(!$id) return false;  
		if(!cache('acl')){
			$model = User::model()->findByPk($id);  
	    	if($model->groups){
	    		//调用 models/Group 
		    	foreach($model->groups as $g){ 
		    		$access = GroupAccess::model()->findAllByAttributes(array('group_id'=>$g->group_id));
		    		if($access){
		 	    		foreach($access as $a){  
			    			$list[] = GroupAccess::access($a->access_id);
			    		} 
		    		}
		    	}
	    	}
	    	cache('acl',$list);
    	}
    	return cache('acl');
	}
 	public function rules()
	{
 		return array(
			array('username, password', 'required'),
			array('username','unique'),
			array('password', 'length', 'min'=>5),
			array('username', 'length', 'max'=>20),
			array('password', 'length', 'max'=>64),
			array('new_password,old_password', 'required','on'=>'update'),
			array('new_password', 'compare', 'compareAttribute'=>'password', 'on'=>'update'),
			array('old_password', 'authenticate', 'on'=>'update'),
			array('id, username, password, created, updated', 'safe', 'on'=>'search'),
		);
	}
	function attributeLabels(){
		return array(
			'old_password'=>__('old_password'),
			'new_password'=>__('new_password'),
			'password'=>__('password'),
			'username'=>__('username'),
			'mygroup'=>__('mygroup'),
		);
	}
	public function authenticate($attribute,$params)
    {
        
        if(!$this->validatePassword($this->old_password,'save_password'))
            $this->addError('old_password',__('incorrect old password.'));
    }
 
	public function search()
	{
 
		$criteria=new \CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new \CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 
    
   
	public function validatePassword($password,$p='password')
	{ 
		return \CPasswordHelper::verifyPassword($password,$this->$p);
	}
	public function hashPassword($password)
	{
		return \CPasswordHelper::hashPassword($password);
	}
 
    public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created',
				'updateAttribute' => 'updated',
				'setUpdateOnCreate' => true
			)
		);
	}
}

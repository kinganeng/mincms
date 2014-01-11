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

class User extends ActiveRecord
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
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
		);
	}
	public function authenticate($attribute,$params)
    {
        
        if(!$this->validatePassword($this->old_password,'save_password'))
            $this->addError('old_password',__('incorrect old password.'));
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

 

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 
    
   
	public function validatePassword($password,$p='password')
	{ 
		return CPasswordHelper::verifyPassword($password,$this->$p);
	}
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

    /**
     * Generates a salt that can be used to generate a password hash.
     *
     * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
     * requires, for the Blowfish hash algorithm, a salt string in a specific format:
     *  - "$2a$"
     *  - a two digit cost parameter
     *  - "$"
     *  - 22 characters from the alphabet "./0-9A-Za-z".
     *
     * @param int cost parameter for Blowfish hash algorithm
     * @return string the salt
     */
    protected function generateSalt($cost=10)
    {
            if(!is_numeric($cost)||$cost<4||$cost>31){
                    throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
            }
            // Get some pseudo-random data from mt_rand().
            $rand='';
            for($i=0;$i<8;++$i)
                    $rand.=pack('S',mt_rand(0,0xffff));
            // Add the microtime for a little more entropy.
            $rand.=microtime();
            // Mix the bits cryptographically.
            $rand=sha1($rand,true);
            // Form the prefix that specifies hash algorithm type and cost parameter.
            $salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
            // Append the random salt string in the required base64 format.
            $salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
            return $salt;
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

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
class NodeField extends ActiveRecord
{
	public $_widget;
	public $_rules;
	public $_automodel; 
	function init(){
		parent::init();
		Yii::import('application.vendor.Spyc');
	}
	function get_relation_table(){
		if($this->relation){
			$arr = explode('.',$this->relation);
			return trim($arr[0]);
		}
		return false;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'node_field';
	}
	function beforeSave(){
		parent::beforeSave(); 
		if($this->validate()){
			if($this->widget)
				$this->widget = serialize( Spyc::YAMLLoadString($this->widget) );
			if($this->rules)
				$this->rules = serialize( Spyc::YAMLLoadString($this->rules) );
			if($this->automodel)
				$this->automodel = serialize( Spyc::YAMLLoadString($this->automodel) );
		}  
		return true;
	}
	function afterSave(){
		parent::afterSave(); 
		Hook::run('model.NodeField_afterSave',$this); 
	}
	function afterFind(){
		parent::afterFind();
		$this->_widget = unserialize($this->widget) ;
		$this->_rules = unserialize($this->rules) ;
		$this->_automodel = unserialize($this->automodel) ;
		$this->widget =  Spyc::YAMLDump($this->_widget);
		$this->rules =  Spyc::YAMLDump($this->_rules);
		$this->automodel =  Spyc::YAMLDump($this->_automodel);
		
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('node_content_id, name,  type', 'required'),
			array('name', 'length', 'max'=>255),
			array('name', 'check'),
			array('type', 'length', 'max'=>50),
			array('id, node_content_id, name, widget, type, value, search, indexes, sort', 'safe', 'on'=>'search'),
		);
	}
	function check($name){
		if(in_array($name,array(
			'id','vid','language_id','uid','created','updated'
			))){
			$this->addError('name',Yii::t('yii','{attribute} "{value}" has already been taken.',array('{attribute}'=>__('name'),'{value}'=>$this->name)));
			return false;
		}
		$model = $this->findByAttributes(array(
					'node_content_id'=>(int)$_GET['id'],
					'name'=>$this->name));
		if($model && $model->id != $this->id){
			$this->addError('name',Yii::t('yii','{attribute} "{value}" has already been taken.',array('{attribute}'=>__('name'),'{value}'=>$this->name)));
			return false;	
		}
		 
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

	  
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria; 
		$criteria->compare('id',$this->id);
		$criteria->compare('node_content_id',$this->node_content_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('widget',$this->widget,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('search',$this->search);
		$criteria->compare('indexes',$this->indexes);
		$criteria->compare('sort',$this->sort);
		//$criteria->order = "sort desc ,id desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

 	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

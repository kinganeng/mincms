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

 
class Access extends \ActiveRecord 
{
 
	public $old_pid;
	public function tableName()
    {
        return 'access';
    } 
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /**
    *
    */
    static function generate($data){
    	foreach($data as $name=>$values){
			$model = static::model()->findByAttributes(array('name'=>$name,'pid'=>0));
			if(!$model){
				$model = new self;
				$model->name = $name;
				$model->pid = 0;
				$model->save();
			}
			$id = $model->id;
			foreach($values as $v=>$op){
				$model = static::model()->findByAttributes(array('name'=>$v,'pid'=>$id));
				if(!$model){
					$model = new self;
					$model->name = $v;
					$model->pid = $id;
					$model->save();
				}
			}
		}
    }
	public function rules()
	{ 
		return array(
			array('name, pid', 'required'),	
		);
	}   
	 
}
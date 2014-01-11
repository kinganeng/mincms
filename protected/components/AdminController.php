<?php
// +----------------------------------------------------------------------
// | 后台权限控制器  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class AdminController extends Controller
{
	 
	public $theme = 'admin';
	public $yiiform;
	public $layout='//layouts/main'; 
	//允许不需要权限可以访问的动作
	public $allow = array();
	protected $langId;//数据库中默认的语言ID
	protected $_config;
	function init(){
		parent::init();
		//配置
		$this->_config();
	}
	function beforeAction($action){
		parent::beforeAction($action);
		if($this->allow && in_array($action->id,$this->allow)){
			return true;
		}
		//判断权限
		$this->_access();
		//取得数据库中默认语言ID
		$this->_defaultDBLanguge();  
		return true;
		
	}
	
 
	
	protected function _access(){
		if(Yii::app()->user->isGuest){
			$this->redirect(url('admin/login/index')); 
		}
	}
	/**
	* 取得数据库中默认语言ID
	*/
	protected function _defaultDBLanguge(){
		$data = cache('defaultDBLanguge');
		if(!$data){
			$row = Yii::app()->db->createCommand()
				->from('languages')
				->where('is_default=:is_defautl',array(':is_defautl'=>1))
				->queryRow();
			$data = $row['id'];
			cache('defaultDBLanguge',$data);
			
			$rows = Yii::app()->db->createCommand()
				->from('languages') 
				->queryAll();
			foreach($rows as $v){
				$all[$v['id']] = $v['name'];
				$code[$v['id']] = $v['code'];
			}
			cache('defaultDBLangugeAll',$all);
			cache('defaultDBLangugeAllCode',$code);
		}
		$this->langId = cache('defaultDBLanguge');
	}
	protected function _config(){
		if(!cache('config')){
			$rows = CDB()->from('configs')->queryAll();
			if($rows){
				foreach($rows as $v){
					$data[$v['name']] = $v['body'];
				}
			}
			cache('config',$data);
		} 
		$this->_config = cache('config');
	}
  
	
}
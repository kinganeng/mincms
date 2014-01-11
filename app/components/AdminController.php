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
	
	private $supperUsers = array(1);
	//部分允许操作列表
	public $_allowAccess = array();
	public $_skip = false;
 
	public $full_action;
	public $minify = false; 
	//所有允许的操作列表
	public $_access;
	
	function init(){
		parent::init(); 
		Yii::import('application.modules.admin.models.User');
		Yii::import('application.modules.admin.models.UserGroup');
		Yii::import('application.modules.admin.models.GroupAccess');
		Yii::import('application.modules.admin.models.Access');
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
		//判断用户是否有权限
		$url = $action->controller->id.'.'.$action->controller->action->id;
		$module = $action->controller->module->id; 
		if($module && $module!=$action->id)
			$url = $module.'.'.$url; 
		//所当前的URL 传入判断权限   
		$this->full_action = $url;
		$this->checkUserAccess($url);    
		return true;
		
	}
	
 
	/**
    * check access
    */
    protected function checkUserAccess($action_id){  
    	$uid = Yii::app()->user->id;//当前用户ID
     	$this->_access = User::access($uid);   
    	if(in_array($uid,$this->supperUsers)) return true; 
    	if(true === $this->_skip ) return true;
    	if(is_array($this->_allowAccess) && in_array($action_id,$this->_allowAccess)) return true;  
    	if(!$this->_access || !in_array($action_id,$this->_access)){
    	  	throw new \Exception(__('access deny'));
    	}
    	
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
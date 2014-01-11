<?php
// +----------------------------------------------------------------------
// |  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $active;
	/**
	* @var 
	*/ 
	public $theme;
	public $hash;
	private $securityManager;
	protected $request;
	function beforeAction($action){
		parent::beforeAction($action); 
		return true;
	}
	function init(){  
		$this->request = Yii::app()->request;
		$AssetManager = Yii::app()->getAssetManager();
		$AssetManager->setBasePath(base_path().'/../_assets/'); 
		$AssetManager->setBaseUrl(base_url().'/_assets');
		
		Yii::app()->theme = $this->theme;
		if(!$this->hash) $this->hash = Yii::app()->params['hash'];
		$this->securityManager = Yii::app()->securityManager;
		$this->securityManager->encryptionKey = $this->hash;
		//设置选中的菜单 
		Helper::set('activeMenu',$this->active);
		//多语言
		if(true == Yii::app()->params['checkBrowsLanguage'])
			$this->_check_language(); 
		//加载hook
		Hook::run('init[]');
	} 
	//检查浏览器语言
	function _check_language(){
		$serverName = $this->request->serverName;
		//语言与当前浏览器设置有关
		$lan = $this->request->preferredLanguage; 
		if(mb_substr_count($serverName,'.')==2){
			$lan = substr($serverName,0,strpos($serverName,'.')); 
		}
		Yii::app()->language = $lan; 
	}
	function encode($value,$key=null){ 
		if($key) $this->securityManager->encryptionKey = $this->hash;
		return base64_encode($this->securityManager->encrypt($value));
	}
	function decode($value,$key=null){ 
		if($key) $this->securityManager->encryptionKey = $this->hash;
		return $this->securityManager->decrypt(base64_decode($value));
	} 
	 
	function view($view,$data=null){
		if(is_ajax())
			$this->renderPartial($view,$data);
		else
			$this->render($view,$data);
	}
}
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('app',__DIR__.'/../');
Yii::setPathOfAlias('modules',__DIR__.'/../modules');
include __DIR__.'/modules.php'; 
if(is_array($include)){
	foreach($include as $file){
		include __DIR__.'/'.$file;
	}
}
$module_lists['gii'] = array( 
	'class'=>'system.gii.GiiModule',
	'password'=>'111',
 	'ipFilters'=>array('127.0.0.1','::1'), 
);
	
// 加载URL路由配置
$urlManager  = include dirname(__FILE__).'/urlManager.php'; 
$urlManager['imagecache']='image/default/index';
$urlManager['<controller:\w+>/<id:\d+>']='<controller>/view';
$urlManager['<controller:\w+>/<action:\w+>/<id:\d+>']='<controller>/<action>';
$urlManager['<controller:\w+>/<action:\w+>']='<controller>/<action>'; 
 
$array =  array(
	'timeZone'=>'Asia/ShangHai',
	
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'language'=>'zh_cn',
    'runtimePath'=>dirname(__FILE__).'/../../temp',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*', 
		'application.fields.*', 
		'application.modules.node.models.*', 
		
	),

	'modules'=>$module_lists,

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
	
		'urlManager'=>array(
			'urlFormat'=>'path',
		//	'urlSuffix'=>'.html',
            'showScriptName'=>false,
			'rules'=>$urlManager,
		),
		
	 
		 'clientScript' => array(
		 	   'packages' => array(
	                'jquery'    => array(
	         			// //ajax.googleapis.com/ajax/libs/jquery/1.7.2/
	                    'baseUrl' => 'misc',
	                    'js'      => array('jquery-1.7.2.min.js'),
	                ),
	                'jquery.ui' => array(
	                    'baseUrl' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/',
	                    'js'      => array('jquery-ui.min.js'),
	                ),
	            ),
	           'class' => 'application.components.minify.ClientScript',
	           'minifyHtml'=>!YII_DEBUG,
	           
	 ),
		// uncomment the following to use a MySQL database
	 
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array( 
                         array( // configuration for the toolbar
		                  'class'=>'ext.yiidebugtb.XWebDebugRouter',
		                  'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
		                  'levels'=>'error, warning, trace, profile, info',
		                  'allowedIPs'=>array('127.0.0.1','::1'),
		                ),
	             ),
        ),
        			  
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		//是否开启浏览器及子域名多语言检测
		'checkBrowsLanguage'=>true,
		'debug'=>true,
		'hash'=>md5('default_hash'),
		'admin_config'=>array(
			'title','seo','open','callus','copy'	
		),
		//发送邮件配置
		'PHPMailer'=>array(
			'Host'=>'smtp.qq.com',
			'Username'=>'',
			'Password'=>'',
		 	'FromName'=>'test',
		 	'From'=>'ss@163.com', //请填写真实的EMAIL地址
			
		),
	),
);
		
$database = include_once dirname(__FILE__).'/database.php';		
$array['components'] = array_merge($database,$array['components']);
$cache = include_once dirname(__FILE__).'/cache.php';		
$array['components'] = array_merge($cache,$array['components']); 
return $array;
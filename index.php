<?php 
defined('YII_DEBUG') or define('YII_DEBUG',true); 
require 'vendor/autoload.php'; 
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/app/config/main.php'; 
if(!defined('YII_DEBUG')) define('YII_DEBUG',false);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
if(true === YII_DEBUG)
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
else
	error_reporting(0);
require_once($yii); 
Yii::createWebApplication($config)->run();

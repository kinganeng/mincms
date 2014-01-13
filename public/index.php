<?php 
defined('YII_DEBUG') or define('YII_DEBUG',true); 
// +----------------------------------------------------------------------
// | Yii 1.x 入口文件
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------  
$yii = __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php'; 
$yiilite = __DIR__. '/../vendor/yiisoft/yii/framework/yiilite.php'; 
$config=__DIR__. '/../app/config/main.php';
if(YII_DEBUG!==true)
	$yii = $yiilite;
if(!defined('YII_DEBUG')) define('YII_DEBUG',false); 
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
if(true === YII_DEBUG)
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
else
	error_reporting(0);
require_once($yii); 
require __DIR__ . '/../vendor/autoload.php'; 
Yii::createWebApplication($config)->run();


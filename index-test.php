<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php'; 

if(true === YII_DEBUG)
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
else
	error_reporting(0);
require_once($yii);
require_once(dirname(__FILE__).'/protected/helpers.php');
Yii::createWebApplication($config)->run();

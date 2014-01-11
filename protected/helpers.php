<?php
// +----------------------------------------------------------------------
// | 实用YII乱写函数
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

function CDB($sql=null){
	return Yii::app()->db->createCommand($sql);
}
 
/**
* current controller action's url
*
* Example:
* <code> 
* url_action('index'); 
* if current controller is site. it is the same as url('site/index')
* </code>
* @param  string $url   action
* @param  array $parmas  params
* @return string  url path
*/
function url_action($url=null,$parmas=null){ 
	if(!$url)  $url = Yii::app()->controller->action->id;
	$url = Yii::app()->controller->id.'/'.$url;
	$module = Yii::app()->controller->module->id; 
	if($module && $module!=Yii::app()->id)
		$url = $module.'/'.$url;  
	return url($url,$parmas);
}
/**
 * 设置COOKIE
 *
 * @param unknown_type $name
 * @param unknown_type $value
 * @return unknown
 */ 
function cookie($name,$value=null,$time=null){
	if($value){
		$cookie=new CHttpCookie($name,$value);
		if($time>0)
			$cookie->expire = time()+$time; 
		return Yii::app()->request->cookies[$name]=$cookie; 
	}
	else{
		$cookie=Yii::app()->request->cookies[$name]; 
		return $cookie->value;
	}
}
/**
 * 加载内部JS
 *
 * @param unknown_type $name
 */
function  core_js($name){
	Yii::app()->getClientScript()->registerCoreScript($name);
}
function core_js_url(){
	return Yii::app()->clientScript->getCoreScriptUrl();
}
/**
 * 发布一个misc目录
 *
 * @param unknown_type $path
 * @return unknown
 */
function publish($path){
	return Yii::app()->getAssetManager()->publish($path);
}
/**
 * 加载published css文件
 *
 * @param unknown_type $file
 */
function css($file,$media=''){ 
	if(is_array($file)){
		foreach($file as $v){
			Yii::app()->getClientScript()->registerCssFile($v,$media);
		}	
	}
	else
		Yii::app()->getClientScript()->registerCssFile($file,$media);
}

/**
 * 直接写style
 *
 * @param unknown_type $file
 */
function css_code($id,$script = null){
	if($script == null) {
		$script = $id;
		$id = md5($script);
	}
	Yii::app()->getClientScript()->registerCss($id,$script);
}
/**
 * 加载published js文件
 *
 * @param unknown_type $file
 */
function js($file){
	if(is_array($file)){
		foreach($file as $v){
			Yii::app()->getClientScript()->registerScriptFile($v);
		}	
	}
	else
		Yii::app()->getClientScript()->registerScriptFile($file);
}
/**
 * 直接写script
 *
 * @param unknown_type $file
 */
function js_code($id,$script = null){
	if($script == null) {
		$script = $id;
		$id = md5($script);
	}
	Yii::app()->getClientScript()->registerScript($id,$script);
}
function has_flash($type){ 
	return Yii::app()->user->hasFlash($type,$msg); 
}
function flash($type,$msg=null){
	if($msg)
		return Yii::app()->user->setFlash($type,$msg);
	else
		return Yii::app()->user->getFlash($type);	
}
function dump($var)
{
	CVarDumper::dump($var, 10, true);
}
function clean_html($s){
	return trim(strip_tags($s));
}

function app(){
	return Yii::app();
}
function url($route,$params=array())
{  
	if($_GET['lang']) $params = array_merge(array('lang'=>$_GET['lang']),$params);
	return Yii::app()->createUrl($route,$params);
}
function h($text)
{
	return htmlspecialchars($text,ENT_QUOTES,Yii::app()->charset);
}
function __($message,  $category = 'app',$params = array(), $source = null, $language = null)
{
	return Yii::t($category, $message, $params, $source, $language);
}
/**
* Yii cache 
*
* Example:
*
* set cache:
* <code> 
* cache('a',123);
* </code>
* get cache:
* <code> 
* cache('a');
* </code>
* @param  string $name   cache key
* @param  string $value  cache value
* @param  string $expire  expire time. default forever
* @return string  if $value null, return cache value
*/
function cache($name,$value=null,$expire=0){  
	if($value===false) return Yii::app()->cache->delete($name);
	$data = Yii::app()->cache->get($name);
	if(!$value) return $data; 
	Yii::app()->cache->set($name,$value,$expire); 
}
 

function config($name)
{
	return Yii::app()->params[$name];
}
/**
* 是否是ajax请求
*/
function is_ajax(){ 
	return Yii::app()->request->isAjaxRequest ? true:false;
}
function ip(){
	return Yii::app()->request->userHostAddress;
}
function host(){
	return app()->request->hostInfo;
}

function base_url(){
	return Yii::app()->baseUrl;
}
function root_path(){
	return Yii::app()->basePath.'/..';
}
function base_path(){
	return Yii::app()->basePath;
}
function theme_url(){
	return Yii::app()->theme->baseUrl;
}
function theme_path(){
	return Yii::app()->theme->basePath;
}
/**
* 设置及取得上级URL
*/
function return_url($url=null){
	if($url)
		return Yii::app()->user->setReturnUrl($url);
	return host().Yii::app()->user->returnUrl;
}
/**
* 批量替换
*/
function new_replace($body,$replace=array()){ 
	foreach($replace as $k=>$v){
		$body = str_replace($k,$v,$body);
	}
 	return $body;
}
/**
* 按alias加载文件
*/
function load_file($alias){
	static $obj; 
	if(!$obj[$alias]){
		$file = Yii::getPathOfAlias($alias).".php";
		if(file_exists($file)){
			include ($file); 
			$obj[$alias] = true;
		}
	} 
	if($obj[$alias])
		return true;
}
/**
* 加载 widgets目录下的widget文件
*/
function widget($name , $properties = array()){ 
	load_file("application.widgets.$name.init");  
	$className = "Widgets_".ucfirst($name)."_Init";
	ob_start();
    ob_implicit_flush(false);
    $widget = Yii::app()->controller->createWidget($className,$properties);
    $widget->run();
    return ob_get_clean(); 
} 
/**
* for Plugins
*/
function widget_before($name,$value){
	if(load_file("application.widgets.{$name}.overwrite")){  
		$className = "Widgets_".ucfirst($name)."_OverWrite";
		return call_user_func ($className.'::before',$value); 
	} 
 
}
function widget_after($name,$value){ 
	if(load_file("application.widgets.{$name}.overwrite")){  
		$className = "Widgets_".ucfirst($name)."_OverWrite";
		return call_user_func ($cls.'::after',$value); 
	}  
}
/**
 * 生成不重复的 UUID
 *
 * @param int $being_timestamp
 * @param int $suffix_len
 *
 * @return string
 */
function uuid()
{
	
	$being_timestamp = 1206576000;
	$suffix_len = 3;
    $time = explode(' ', microtime());
    $id = ($time[1] - $being_timestamp) . sprintf('%06u', substr($time[0], 2, 6));
    if ($suffix_len > 0)
    {
        $id .= substr(sprintf('%010u', mt_rand()), 0, $suffix_len);
    }
    return $id;
}
function encode($name){
	return base64_encode(Yii::app()->controller->encode($name));
}
function decode($name){
	return Yii::app()->controller->decode(base64_decode($name));
}


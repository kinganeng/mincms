<?php
/**
* 文章设置
*/
/**
* 取得分类
*/
class Module_Post_Config{
	static function category(){
		$db = Yii::app()->db->createCommand();
		$db->setFetchMode(PDO::FETCH_OBJ);
		$rows = $db 
				->from('category') 
				->queryAll(); 
		if($rows){ 
			foreach($rows as $v){  
				$tree[$v->id] = $v; 
			}   
			$category = ArrHelper::tree($tree);
		}
		return array($category,$tree);
	}
	
	/**
	* 语言
	*/
	static function language(){
		$rows = Yii::app()->db->createCommand() 
				->from('languages') 
				->queryAll();
		$language = array();
		if($rows){
			foreach($rows as $v){
				$language[$v['id']] = $v['name'];
			}
		}
		return $language;
	} 
	static function  name($v){   
		return "<input type='hidden' value='".$v['id']."' name='ids[]'>".$v['title'];
	}
}
$categoryAll = Module_Post_Config::category();
$category = $categoryAll[0];
$category[""] = __('please select'); 
  
$language = Module_Post_Config::language();
$language[""] = __('please select'); 

/**
* 列表中显示对应分类的名称
*/
function post_config_cateogry($v){
	$id = $v['category_id'];
	$categoryAll = Module_Post_Config::category();
	$category = $categoryAll[1];
	$v = $category[$id]; 
	return $v->name;
}
/**
* 语言
*/
function post_config_language($v){
	$id = $v['language_id'];
	$language = Module_Post_Config::language();
	$str = LanguageHelper::img('posts',$v['vid'] ,'post/default/update');
	return $language[$id]. "| ".$str." ";
}
return array(
	'title'=>array( 
		'type'=>'input', 
		'index'=>true,
		'search'=>true,
		'_value'=>'php:Module_Post_Config::name',
	),
	'body'=>array( 
		'type'=>'text',
		'index'=>true,	
		'widget'=>array(
			'ckeditor'=>array(
				'tag'=>'AutoModel_body'
			),
			'attachment'=>array(
				'tag'=>'AutoModel_body'
			)
		),
	),
	'category_id'=>array( 
		'type'=>'select',
		'datas'=>$category,
		'index'=>true,	
		'_value'=>"php:post_config_cateogry"
	),
	'language_id'=>array( 
		'type'=>'select',
		'datas'=>$language,
		'index'=>true,	
		'search'=>true,
		'_value'=>"php:post_config_language"
	),
	//验证规则
	'_rules'=>array( 
	    array('title,body', 'required'), 
	),
	//是否顶部显示错误信息
	'_error'=>1,
	//是否是多语言
	'_multiLanguage'=>true,
	//模块
	'_AutoModel'=>array(
		'AdminUid'	,'Time','Vid'
	),
	
);
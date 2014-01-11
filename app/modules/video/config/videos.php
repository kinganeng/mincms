<?php
/**
* 视频
*/ 
class Module_Video_Config{ 
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
   
$language = Module_Video_Config::language();
$language[""] = __('please select'); 
 
/**
* 语言
*/
function video_config_language($v){
	$id = $v['language_id'];
	$language = Module_Video_Config::language();
	$str = LanguageHelper::img('videos',$v['vid'] ,'video/default/update');
	return $language[$id]. "| ".$str." ";
}
return array(
	'title'=>array( 
		'type'=>'input', 
		'index'=>true,
		'search'=>true,
		'_value'=>'php:Module_Video_Config::name',
	),
	
	'image'=>array( 
		'type'=>'input',  
	),
	'video'=>array( 
		'type'=>'input',  
	),
	'body'=>array( 
		'type'=>'text', 
		'widget'=>array(
			'ckeditor'=>array(
				'tag'=>'AutoModel_body'
			),
			'attachment'=>array(
				'tag'=>'AutoModel_body'
			)
		),
	),
	'language_id'=>array( 
		'type'=>'select',
		'datas'=>$language,
		'index'=>true,	
		'search'=>true,
		'_value'=>"php:video_config_language"
	),
	//验证规则
	'_rules'=>array( 
	    array('title,body,image,video', 'required'), 
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
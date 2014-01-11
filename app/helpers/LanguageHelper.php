<?php  
// +----------------------------------------------------------------------
// | LanguageHelper::img($table,$vid  $url='post/default/update') 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class LanguageHelper
{ 
	/**
	* 取得当前记录，已经存在的多语言
	*/
   static function languages($table,$vid){
		$a = cache('language_'.$table.$vid); 
		if(!$a){ 
			$all = Yii::app()->db->createCommand()
					->from($table)
					->where("vid=:vid",array(':vid'=>$vid))
					->queryAll(); 
			if($all){
				foreach($all as $v){
					$a[$v['id']] = $v['language_id']; 
				}
				cache('language_'.$table.$vid,$a);
			}
		}
		return $a;
	}
   static $_url;
   static function img($table,$vid , $url='post/default/update'){ 
   	    $str = "";
   	    $rows = self::languages($table,$vid); 
		if($rows){
			//defaultDBLangugeAll defaultDBLangugeAllCode
			$all = cache('defaultDBLangugeAll');
			foreach($rows as $sid=>$language_id){   
				if(is_array($url)){	
					$url[1]['id'] = $sid; 
					$urls =  url($url[0],$url[1]);  
				}else{
					$urls = url($url);
				} 
				$s = Chtml::image(base_url().'/misc/gq/'.strtolower($all[$language_id]).".gif"); 
				$s = strtolower($all[$language_id]);
				$str .= CHtml::link($s,$urls); 
				$str .= "&nbsp;"; 
			}
		} 
		return $str;  
   }
   
}
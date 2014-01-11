<?php
// +----------------------------------------------------------------------
// | 管理UPLOAD目录
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class ManageController extends AdminController
{ 
 
 	//public $layout='//layouts/column2';
	public $active = array('image.manage','admin.default');
	static $dir;
	public function actionIndex()
	{       
		$id = $_GET['file_id'];
		if($id){
			$id = base64_decode($id);
			$id = '/'.$id;
		}
		$path = root_path().'/upload'.$id;
		$url = base_url().'/upload'.$id;
		$name = 'upload'.$id; 
		 
		/**
		* urlpath生成
		*/
		$arr = explode('/',$name);
	 	 
		foreach($arr as $v){
			if($v != 'upload')
			  $n .= $v.'/';
			$link = url('image/manage/index',array('file_id'=>base64_encode($n)));
			$urlpath[] = "<a href='".$link."'>$v</a>";
		}
 
		if(!function_exists('finfo_open')){
		 		
		}
		$dirs = scandir($path);
 		foreach($dirs as $d){
 			if( $d != '.' && $d != '..'&& $d != '.svn' && $d != '.git' && $d != '.gitignore'){
 				if(is_dir($path.'/'.$d)){ 
 					$fullDir = $id.'/'.$d;
 					if(substr($fullDir,0,1)=='/')
 						$fullDir = substr($fullDir,1);
 				 
 					$listDir[$url.'/'.$id.$d] = array(
 						'name'=>$d, 
 						'size'=>ceil(filesize($path.'/'.$d)/1024).' kb', 
 						'fullDir'=>$fullDir,
 						'time'=>date("Y-m-d H:i:s",filemtime($path.'/'.$d)),
 					);
 					
 				}else{
 					//取得文件类型
 					$finfo    = finfo_open(FILEINFO_MIME);
					$mimetype = finfo_file($finfo ,$path.'/'.$d);
					finfo_close($finfo);
					$mimetype = substr($mimetype,0,strpos($mimetype,';'));
					//判断文件是不是图片
					$img = false;
 				 	if(strpos($mimetype,'image')!==false){
 				 		$img = true;
 				 	} 
 					$listFile[$url.'/'.$d] = array(
 						'name'=>$d, 
 						'size'=>ceil(filesize($path.'/'.$d)/1024).' kb',
 						'time'=>date("Y-m-d H:i:s",filemtime($path.'/'.$d)),
 						'type'=>$mimetype,
 						'img'=>$img,
 					);
 				}
 			}
 		}
	 
	  	$this->render('index',array(
	  		'listDir'=>$listDir,
	  		'name'=>$name,
	  		'urlpath'=>$urlpath,
	  		'listFile'=>$listFile,
	  	));
	}
}
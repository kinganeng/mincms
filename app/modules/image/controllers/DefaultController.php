<?php
// +----------------------------------------------------------------------
// | 生成图片 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
/**
RewriteCond %{REQUEST_FILENAME} !\.(jpg|jpeg|png|gif)$
RewriteRule /upload/(.*)$ /imagine.html?id=upload/$1 [NC,R,L]  

$opts = array(
	'resize'=>array(300,200),
	'rotate'=>45,
	'border'=>array(10,'red'),
	'rounded'=>array(10, "tl tr"), 
);  
 
echo image('upload/1.jpg',$opts); //生成完整图片
echo image_url('upload/1.jpg',$opts); //只返回URL

*/
class DefaultController extends Controller
{
 
	public $layout = false;
	public function actionIndex()
	{        
	 	Yii::import("application.modules.image.lib.Fuel_Image");  
		$name = $_GET['id'];  
		$ext = substr($name,strrpos($name,'.')+1);
		$name = substr($name,0,strrpos($name,'.')); 
		$l = strpos($name,'='); 
		//生成新的文件名
		$new_name = root_path().'/public/imagine/'.$name.'.'.$ext; 
		//取得encode的数组
		$json = substr($name,$l+1);   
		$name = substr($name,0,$l);   
		$arr = explode('/',$name); 
		//完整文件名
		$file = $name.'.'.$ext;
		//文件所在路径 
		$file_path = root_path().'/public/'.$file;  
 
		if(!file_exists($file_path)){
			//如原文件不存在直接返回
			echo "image error";
			return;
		}
		//生成新文件所存在的路径 
		$new_dir = FileHelper::dir($new_name);
		if(!is_dir($new_dir)) mkdir($new_dir,0777,true);   
		$json = cache($json); 
		//操作图片 
		$imagine = Fuel_Image::load($file_path);
	 
 		foreach($json as $k=>$v){
			switch($k){
				case 'resize': 
					$imagine = $imagine->resize($v[0], $v[1],  $v[2]?$v[2]:true, $v[3]?$v[3]:false);
					break;
				case 'crop': 
					//crop(20, 20, 180, 180);
					$imagine = $imagine->crop($v[0], $v[1], $v[2], $v[3]);
					break;
				case 'crop_resize':
					$imagine = $imagine->crop_resize($v[0], $v[1]);
					break;
				case 'rotate': 
					$imagine = $imagine->rotate($v);
					break;
				case 'flip':
					//vertical horizontal both
					$imagine = $imagine->flip($v);
					break;
				case 'watermark':
					/*
					* watermark('watermark.ext', "top left", 15);
					* watermark('watermark.ext', "bottom right");
					* watermark('watermark.ext', "center middle");
					*/   
					$imagine = $imagine->watermark($v[0],$v['ps'],$v[2]);
					break;
				case 'border':
					//border(10, '#000000');
					$imagine = $imagine->border($v[0],$v[1]);
					break;	
				case 'mask':
					//mask('mask.ext');	
					$imagine = $imagine->mask($v);
					break;	
				case 'rounded':
					/*
					* rounded(10, "tl tr");
					* rounded(10, null, 0);
					* rounded(10);
					*/
					$imagine = $imagine->rounded($v[0],$v[1],$v[2]);
					break;	
				case 'grayscale':
					$imagine = $imagine->grayscale();
					break;
					
			} 
		}  
		//生成图片
    	$imagine->save($new_name);   
    	echo @file_get_contents($new_name);  
		exit; 
	}
}
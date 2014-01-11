<?php  

function image($file,$option=array()){
	$url = image_url($file,$option);
	return CHtml::image($url);
}
function image_hq($arr){
	$img = $arr[1];
	$img = str_replace('/imagine/','',$img);
	$ext = FileHelper::ext($img);
	$img = substr($img,0 ,strrpos($img,'=')).$ext; 
	return $img;
}
function image_url($file,$option=array()){   
	$value = serialize($option);
	$id = 'image_fuel'.md5($file.$value);
	$data = cache($id);
	if(!$data){
		 cache($id,$option);
	} 
	$name = FileHelper::name($file);
	$ext = FileHelper::ext($file); 
	return base_url()."/imagine/".$name."=$id{$ext}";;
}
 
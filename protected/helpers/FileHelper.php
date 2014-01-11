<?php   
// +----------------------------------------------------------------------
// | 文件
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class FileHelper  
{ 
	public $admin = 1;
	public $uid;
	public $name; 
	
	
	function __construct(){
		if(!$this->uid)
			$this->uid = Yii::app()->user->id;
	}
	
	static function attachment($fid){
		$d = cache('attachments_'.$fid);
		if(!$d){
			$row = CDB()->from('attachments')->where("id=:id",array(':id'=>$fid))->queryRow();
			$d = array('name'=>$row['name'],'fullpath'=>$row['fullpath']);
			cache('attachments_'.$fid,$d);
		}
		return $d;
	}
	function pdf($file ,$filename='1.pdf' ){ 
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($file));
		header('Accept-Ranges: bytes'); 
		@readfile($file);
	}
	function upload($http_url=null){ 
		$url = "upload/".date('Y').'/'.date('m').'/'.date('d');
		$dir = root_path().'/'.$url; 
		$temp_dir = root_path().'/upload/temp';
		if(!is_dir($dir)) mkdir($dir,0775,true);
		if(!is_dir($temp_dir)) mkdir($temp_dir,0775,true); 
		if($http_url) {
			return $this->_upload($http_url,array(
				'url'=>$url,
				'dir'=>$dir,
				'temp_dir'=>$temp_dir,
			));
		}
		if(!$_FILES)return; 
		
		foreach($_FILES as $k=>$f){
			$tmp_name = $f['tmp_name'];
			$name = $f['name'];
			$key = uniqid('', true).json_encode($f);
			$name = md5($key).".".self::extension($name);
			$to = $dir.'/'.$name;
			$old = $temp_dir.'/'.$name;  
			move_uploaded_file($tmp_name,$old); 
			$this->name = $name;
			$row = $this->_upload_db($old,$to,$url.'/'.$name,$f['size'],$f['type']);
			$ret[] = $row;
		}  
	 	return $row;	
	}
	function _upload($http_url,$ar){
		$name = uniqid('', true).md5($http_url).".".self::extension($http_url);
		$data = @file_get_contents($http_url);
		$old = $ar['temp_dir'].'/'.$name; 
		@file_put_contents($old,$data);
	 	$to = $ar['dir'].'/'.$name;  
	 	$size = filesize($old);
	 	if($size<5) {
	 		@unlink($old);
	 		return;
	 	}
	 	$type = filetype($old); 
		$row = $this->_upload_db($old,$to,$ar['url'].'/'.$name,$size,$type);
		return $row;
	}
	function _upload_db($old,$to,$path,$size,$type){
		$data = file_get_contents($old);
		$uniqid =  md5($data); 
		$row = Yii::app()->db->createCommand()->from('attachments') 
				->where('uniqid=:uniqid',array(':uniqid'=>$uniqid))
				->queryRow(); 
		if(!$row){ 
			copy($old,$to);   
		 	unset($model);
		 	if($path && $size>0){
		 		$model['name'] = $path;
				$model['fullpath'] =$path;
				$model['uniqid'] =$uniqid;
				$model['size'] =$size;
				$model['type'] =$type;  
				$model['uid'] =$this->uid;
				$model['created'] =time();
				$model['is_admin'] =$this->admin;
			 	Yii::app()->db->createCommand()->insert('attachments' , $model);
			 	$row = Yii::app()->db->createCommand()->from('attachments') 
					->where('uniqid=:uniqid',array(':uniqid'=>$uniqid))
					->queryRow(); 
		 	}  
		}
	 
		@unlink($old);
		return $row;
	}
	/**
	* full name
	* upload/1.jpg
	*/
	static function name($name){ 
		return substr($name,0,strrpos($name,'.')); 
	}
	/**
	* upload/1.jpg
	* 1
	*/
	static function cute_name($name){ 
		$n = strlen(self::ext($name)); 
		return substr($name,strrpos($name,'/')+1,0-$n); 
	}
	static function ext($name){
		return '.'.self::extension($name);
	}
	static function extension($name){ 
		return substr($name,strrpos($name,'.')+1); 
	}
	static function dir($file_name){ 
		return substr($file_name,0, strrpos($file_name,'/'));
	}
	static function size($file) {
		 $filesize =  filesize($file);
		 if($filesize >= 1073741824) {
		  	$filesize = round($filesize / 1073741824 * 100) / 100 . ' gb';
		 } elseif($filesize >= 1048576) {
		  	$filesize = round($filesize / 1048576 * 100) / 100 . ' mb';
		 } elseif($filesize >= 1024) {
		 	 $filesize = round($filesize / 1024 * 100) / 100 . ' kb';
		 } else {
		 	 $filesize = $filesize . ' bytes';
		 }
		 return $filesize;
	}
	/**
	* 返回input
	*/
	static function input($files,$field){
	 	 if(!$files)return; 
	 	 foreach($files as $f){ 
		 	$tag .= self::input_one($f,$field);
 		}
 		 
 		return $tag;
	 }
	 static function input_one($f,$field,$is_tag = true){
	 	
	 	$f = (object)$f; 
	 	if(true === $is_tag){
		 	$tag = "<div class='file img-polaroid'><span class='glyphicon glyphicon-remove icon-remove hander'></span>
			 	<input type='hidden' name='".$field."[]' value='".$f->id."' >";
		} 
			$flag = false;
			if(strpos($f->type,'image')!==false){
				$flag = true;  
				$tag .= "<a href=".image_url($f->fullpath,array(
					'resize'=>array(800,600)
				))." class='group cboxElement' '>"
				.image($f->fullpath,array(
					'resize'=>array(130,78,true,true)
				))."</a>";
			} 
			else if(in_array(self::extension($f->fullpath),array('flv','mp4','avi','rmvb','webm'))){
				$flag = true;
				$tag .= "<img src='".base_url().'/misc/default/img/video.png'."' />";
			}
			
			switch (self::extension($f->fullpath)) {
				case 'zip': 
					$tag .= "<img src='".base_url().'/misc/default/img/zip.png'."' />";
					break;
				case 'txt': 
					$tag .= "<img src='".base_url().'/misc/default/img/txt.png'."' />";
					break;
				case 'pdf': 
					$tag .= "<img src='".base_url().'/misc/default/img/pdf.png'."' />";
					break;
				case 'doc': 
					$tag .= "<img src='".base_url().'/misc/default/img/word.png'."' />";
					break;
				default:
					if(false === $flag)
						$tag .= "<img src='".base_url().'/misc/default/img/none.png'."' />";
					break;

			} 
			if(true === $is_tag){
				$tag .="</div>"; 
			}
			return $tag;
	 }
}
<?php
// +----------------------------------------------------------------------
// | 语言包翻译 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class DefaultController extends AdminController
{
	public $active = array('i18n.default','admin.default');
	public function actionIndex()
	{
		$id = $_GET['id'];
		$name = $_GET['name'];
		$path = base_path().'/messages'; 
		$list = scandir($path);
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{  
				$dirs[$vo] = $vo;
				$li = scandir($path.'/'.$vo);
				foreach($li as $v){   
					if($v !="."&& $v !=".." && $v !=".svn" )
					{
						 $dir[$vo][] = $v;
					}
				}
			}
		} 
		if($id){
			$file = $path.'/'.$name.'/'.$id;
			$content = @include $file;
		 
		}
		if($_POST){
			$lan = $_POST['lan'];
			$key = $_POST['key'];
			$value = $_POST['value'];
			$write = $path.'/'.$lan.'/'.$id;
		 
			foreach($key as $k=>$v){
				if(trim($v) && trim($value[$k]))
					$out[trim($v)] = trim($value[$k]);
			}
			file_put_contents($write,"<?php \nreturn  ".var_export($out,true).";");
		 	flash('success',__('success') . "# ".$name."/".$id);
		 	$this->refresh();
		}
		return $this->render('index',array(
			'dirs'=>$dirs,
			'dir'=>$dir,
			'id'=>$id,
			'name'=>$name,
			'content'=>$content
		));
	}
}
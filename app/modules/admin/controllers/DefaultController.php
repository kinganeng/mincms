<?php
// +----------------------------------------------------------------------
// |  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class DefaultController extends AdminController
{
	public function actionIndex()
	{   
		$rows = CDB()->from('configs')->queryAll();
		if($rows){
			foreach($rows as $v){
				$data[$v['name']] = $v['body'];
			}
		}
		if($_POST['config']){
			$config = $_POST['config']; 
			if($config){
				CDB()->update('configs',array('body'=>""));
				foreach($config as $k=>$v){
					$row = CDB()->from('configs')->where("name=:name",array(':name'=>$k))->queryRow();
					if(!$row)
						CDB()->insert('configs',array('name'=>$k,'body'=>$v));
					else{ 
						CDB()->update('configs',array('body'=>$v),"name=:name",array(':name'=>$k));
					}
				}
				flash('success',__('success'));
				cache('config',false);
				$this->refresh();
			}
		}
		$this->render('index',$data);
	}
}
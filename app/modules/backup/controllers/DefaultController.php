<?php
// +----------------------------------------------------------------------
// | 备份数据库 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class DefaultController extends AdminController
{
	public $active = array("backup.default",'admin.default');
	public $path;
	public $bin;
	public $name;
	public $pwd;
	public $db_name;
	public $host;
	public $file;
	function init(){
		parent::init();
		$this->path = root_path().'/data';
		if(!is_dir($this->path)) mkdir($this->path,0777,true);
		$row = Yii::app()->db->createCommand("SHOW VARIABLES LIKE '%basedir%'")->queryAll();
 	 	$this->bin = $row[0]['Value'].'/bin/'; 
		$dsn = Yii::app()->db->connectionString; 
		$n = explode(';',$dsn); 
		$this->host = substr( $n[0] ,strpos($dsn,'=')+1);   
		$this->db_name = substr( $dsn ,strrpos($dsn,'=') +1); 
		$this->name = Yii::app()->db->username;
		$this->pwd = Yii::app()->db->password;
	 	$dir = $this->path."/".$this->db_name."_";
		$this->file = $dir.date('Ymd-H-i-s',time()).'.sql'; 
	}
	
	public function actionIndex()
	{   
		$this->active = array('extend','backup.admin.index');
		$list = scandir($this->path);
		foreach($list as $vo){
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{
				$rows[$vo]=filemtime($this->path.'/'.$vo);
			}
		}
		if($rows)
			$rows = array_reverse($rows);
		
	 	$data['rows'] = $rows;
	 	$data['dir'] = $this->path;
	 	return $this->render('index',$data);
	}
	
 	public function actionDo($id){ 
 		switch($id){ 
 			case 'store':
				$sql = $this->bin."mysqldump -h ".$this->host." -u".$this->name." -p".$this->pwd." ".$this->db_name." >  ".$this->file;  
				$msg = __("success");
				break;
				
			case 'restore':
			/*	$sql = $this->bin."mysql -h ".$this->host." -u".$this->name." -p".$this->pwd." ".$this->db_name." <  ".$this->file; 
				$msg = __("success");*/
 				break;
		}
	 	if($sql)
			exec($sql);
		flash('success',$msg);
		$this->redirect(url('backup/default/index'));
 	}
}
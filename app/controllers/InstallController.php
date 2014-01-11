<?php  
// +----------------------------------------------------------------------
// | 安装程序
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class InstallController extends FrontController
{ 
	public $minify = false; 
	public $bin;
 	public $db;
 	public $theme = 'install'; 
	function init(){
		parent::init();   
		 
	 
	}
	 
 	/**
 	$arr['db'] = array(
			'connectionString' => 'mysql:host=localhost;dbname=yii',
			'emulatePrepare' => true,
			'username' => 'test',
			'password' => 'test',
			'charset' => 'utf8',
	);
	return $arr;
 	*/
	public function actionIndex()
	{   
		Yii::import('application.modules.admin.models.User');   
		$model = new Install();
		$file = base_path().'/config/database.php';  
		if(!is_writable($file)){
			$data['error'] = __('config/database.php is not writable');
		}
		$model->host = "localhost";
		if ($_POST){ 
			$model->attributes=$_POST['Install']; 
			if($model->validate() && !$data['error']) {
				$dsn = "mysql:host=".trim($model->host).";dbname=".trim($model->host_db);
				$username = trim($model->host_user);
				$model->host_pwd = $password = trim($_POST['Install']['host_pwd']);  
				$db = new InstallDB;   
				$db->connect($dsn,$username,$password); 
				if(!$db->id){
					$data['error'] = __('connect host failed');
				}else{
					$file_install = base_path().'/config/database_install.php';  
					$content = file_get_contents($file_install);
					$content = str_replace('{dsn}',$dsn,$content);
					$content = str_replace('{user}',$username,$content);
					$content = str_replace('{pwd}',$password,$content);  
					file_put_contents($file,$content); 
					$rows = $db->query("SHOW TABLES")->all(); 
					if($rows){
						foreach($rows as $r){
							foreach($r as $v)
								$li[] = $v;
						}
					} 
					if(!$li || !in_array('access',$li)){
						$row = $db->query("SHOW VARIABLES LIKE '%basedir%'")->one(); 
						$this->bin = $row->Value; 
						$file = base_path().'/data/install.sql';
						if(!file_exists($file))
							exit('file not exists!');
						$sql = $this->bin."/bin/mysql    -u".$username." -p\"".$password."\" ".trim($model->host_db)." <  ".$file; 
   					 
   						if(exec($sql)){
   							$UserModel = new User;
   							$UserModel->username = $model->username;
   							$UserModel->email = $model->email;
   							$UserModel->password = $model->password;
   							$UserModel->active = 1;
   							$UserModel->created = time();
   							$UserModel->save(); 
   						}
   						
					} 
				 	
					flash('success',__('install success')); 
 					$this->redirect(url('install/success'));
				}
			}
		}
		$data['url'] = $url;
		$data['model'] = $model;
		return $this->render('index',$data);
	}
	function escap($str){
		return addslashes($str);
	}
	function actionSuccess(){
		return $this->render('success');
	}
	 
	 
}

class InstallDB{
	protected $_conn;
	protected $_query;
	public $id;  
	function connect($dsn,$user,$pwd){
		try {
			$this->_conn = @new PDO($dsn,$user,$pwd,array(
				PDO::ATTR_PERSISTENT=>true
			));
			$this->id = true; 
		} catch (PDOException $e) { 
		    $this->id = false;
		}
	}
	function query($sql){
		$this->_query = $this->_conn->prepare($sql); 
		$this->_query->execute();
		return $this;
	}
	function one(){
		return $this->_query->fetch(PDO::FETCH_OBJ);
	}
	function all(){
		while($list = $this->_query->fetch(PDO::FETCH_OBJ)){
			$data[] = $list;
		}
		return $data;
	}
} 

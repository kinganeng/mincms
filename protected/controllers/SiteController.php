<?php

class SiteController extends FrontController
{ 
	public function actionIndex()
	{    
		$node = Node::find('post',5);
		dump($node);
		echo 1;exit;
		//选中菜单 
		Helper::set('activeMenu',"site.index"); 
		$this->render('index');
	}
	
	public function actionWhy()
	{  
		
		Helper::set('activeMenu',"site.why");
		$this->render('why');
	}
	public function actionTest()
	{  
	 
		$this->layout = false;
		$this->render('test');
	}
 
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	 
}
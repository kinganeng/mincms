<?php

class SiteController extends FrontController
{ 
	public function actionIndex()
	{     
		 
		//选中菜单 
		Helper::set('activeMenu',"site.index"); 
		$this->render('index',array(
			'pages'=>$pages,
			'posts'=>$posts,
		));
	}
 
	
	public function actionWhy()
	{  
		
		Helper::set('activeMenu',"site.why");
		$this->render('why');
	}
	function actionTest(){
	 
		echo "<img src='".url('site/qr')."' />";
	}
	public function actionQr()
	{  
	 
	 	$qrCode = new \Endroid\QrCode\QrCode();
		$qrCode->setText("http://mincms.com");
		$qrCode->setSize(250);
		$qrCode->setPadding(10);
		echo $qrCode->render();
		exit;
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
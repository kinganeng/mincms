### 安装说明
 * 下载composer.phar(http://getcomposer.org/)
 * 执行代码 `php composer.phar install` 
 * 默认系统发送邮件使用的是PHPMailer,如果要使用`swiftmailer`
 * 请在`require`中加入  "swiftmailer/swiftmailer": "5.1.*@dev" 
 * 如果移除 "yiisoft/yii": ">=1.1.14" 这行，请使用  `php composer.phar dump-autoload` 
 * 并自行下载yii 1.1.14 解压至与项目同级目录即可。
 * 直接访问 `yourdomain/install` 执行安装
 
	{  
	 
		"require": {
			"php": ">=5.3.0",   
			 "yiisoft/yii": ">=1.1.14" 
		},
	        "autoload": {
		        "classmap": [
		            
		        ],
		    	"files": [
			       "./app/helpers.php",
			       "./app/Hook.php"		
		    	],
		        "psr-0": {
			    	"app": "./" 
		            
		        }
		 } 
	       
	 
	 
	}


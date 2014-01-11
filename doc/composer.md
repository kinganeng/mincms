### Composer.json 说明
 * 其中如果安装yii出现很慢可以删除 `"yiisoft/yii": ">=1.1.14",` 这么
 * 改用直接下载的方式，解决yii文件包至与项目同级目录即可。

 
	{  
	 
		"require": {
			"php": ">=5.3.0",   
			 "yiisoft/yii": ">=1.1.14",
			"swiftmailer/swiftmailer": "5.1.*@dev"  
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


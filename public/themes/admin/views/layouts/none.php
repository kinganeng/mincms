<!DOCTYPE HTML>
	<head> 
	<meta charset="utf-8">
 	<?php 
 		css(base_url().'/misc/bootstrap/css/bootstrap.min.css');
 		css(theme_url().'/misc/app.css');
 		js(base_url().'/misc/jquery-1.7.2.min.js');	 
 		js(base_url().'/misc/bootstrap/js/bootstrap.min.js');	
 	?> 
	<title><?php echo __('admin login'); ?></title>
</head>

<body>
 
  	
	<div class='container'>	
		<?php echo $content; ?>
      
		
	</div>
   

</body>
</html>

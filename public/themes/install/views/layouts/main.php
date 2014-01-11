<!DOCTYPE HTML>
	<head> 
	<meta charset="utf-8">
  	<?php 
  	   	core_js('jquery');
 		css(base_url().'/misc/bootstrap/css/bootstrap.min.css');  
 		css_code("
 			.label-default a{color:#fff;}
 			label{display:block;}
 			.label{color:black;}
 			#acl label{margin-right:5px;}
 		");
 	 
 	?> 
 	<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>/misc/html5shiv.js"></script>
	<![endif]-->
	<title><?php echo __('Install'); ?></title>
</head> 
<body> 
       <div   class="container" id='main'>  
			<?php echo $content; ?>  
	    </div> 
 

</body>
</html>

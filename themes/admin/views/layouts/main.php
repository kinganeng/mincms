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
 		js(base_url().'/misc/bootstrap/js/bootstrap.min.js');
 	 	js(base_url().'/misc/php.js');
 		widget("imagesloaded",array('tag'=>'img'));	
 	//	widget('select2');
 	?> 
 	<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>/misc/html5shiv.js"></script>
	<![endif]-->
	<title><?php echo __('admin panel'); ?></title>
</head> 
<body> 
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
      <a class="navbar-brand" href="<?php echo url('admin/default/index'); ?>"><?php echo __('admin panel'); ?></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <?php $this->widget("application.modules.menu.widget.adminMenu");?>
      </ul> 				
      <?php if(!Yii::app()->user->isGuest){?>  
	      <ul class="nav navbar-nav navbar-right">
	      		<a href="<?php echo url('admin/logout/index');?>"> 
	        	<span class="glyphicon glyphicon-user"></span> <?php echo Yii::app()->user->username;?>
	        	<span class="glyphicon glyphicon-log-in" title="<?php echo __('logout');?>"></span></a>
	      </ul>
      <?php }?>
    </div><!--/.nav-collapse -->
  </div>
</div>
 
      <div   class="container" id='main'>
      	  
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'htmlOptions'=>array('class'=>'breadcrumb'),
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		<div class="alert alert-success flash-message" style="position: fixed;
top: 0;
z-index: 9999;
width: inherit;display:none;"></div>  
		<?php 
                //显示flash message
                foreach(array('success','error','danger') as $type){ 
                $cls = $type;
                if($type=='error') $cls='danger';
                if(has_flash($type)){ ?>
                <div class="alert alert-<?php echo $cls;?> flash-message"><?php echo flash($type);?></div>
        <?php }}?>  
		
		
		<?php echo $content; ?> 

    
    </div> 
 

</body>
</html>

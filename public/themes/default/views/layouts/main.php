<?php /* @var $this Controller */ ?>
<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />  
 	<?php 
 		css(theme_url().'/css/style.css');
 		css(theme_url().'/css/home.css');
 		core_js('jquery');	 
 		js(theme_url().'/js/DD_belatedPNG0.0.8a-min.js');	
 		js_code("fix","DD_belatedPNG.fix('.pic, .china, .leftxin img');");
 	?> 
 	<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>/misc/html5shiv.js"></script>
	<![endif]-->
	<title><?php echo __('front site title'); ?></title>
</head>

<body>
 
<div class="main">
    	<div class="top">
        	<img class="logo" src="<?php echo theme_url();?>/images/ying.jpg" width="328" height="80" />
            <div class="top_right">
            	<div class="tel">
                    <p class="pic"><img src="<?php echo theme_url();?>/images/call.png" width="61" height="13" /></p>
                    <p class="pic"><img src="<?php echo theme_url();?>/images/tel.png" width="187" height="30" /></p>
                    <p class="pic">info@miraclemandarin.com
                    	<span class="china">中文<input name="" type="button" /></span>
                    </p>
                    <p class="pic tupic">
                    	<span><img src="<?php echo theme_url();?>/images/10.jpg" /></span>
                        <span><img src="<?php echo theme_url();?>/images/11.jpg" /></span>
                        <span><img src="<?php echo theme_url();?>/images/12.jpg" /></span>
                        <span><img src="<?php echo theme_url();?>/images/13.jpg" /></span>
                        <span><img src="<?php echo theme_url();?>/images/14.jpg" /></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="mainnav">
        	<ul class="nav">
    			<?php 
    				$menus = CDB()->from('menus')
    						->where('is_admin=0')
							->order("sort desc,id desc")
							->queryAll();
					foreach($menus as $v){
    			?>
            	<li class="<?php if(Helper::activeMenu($v['url'])){?>se<?php }?>">
            		<a href="<?php echo url($v['url']);?>"><?php echo __($v['name']);?></a></li>
                <li><img src="<?php echo theme_url();?>/images/line.jpg" width="2" height="45" /></li>
                <?php }?>
            </ul>
        </div>		
		<?php echo $content; ?> 
		<div class="m-list">
        	<ul>
            	<li><img src="<?php echo theme_url();?>/images/b01.jpg" width="208" height="130" /></li>
                <li><img src="<?php echo theme_url();?>/images/b02.jpg" width="208" height="130" /></li>
                <li><img src="<?php echo theme_url();?>/images/b03.jpg" width="208" height="130" /></li>
                <li><img src="<?php echo theme_url();?>/images/b04.jpg" width="208" height="130" /></li>
            </ul>
            <div class="telzong">
        		<img class="pictel" src="<?php echo theme_url();?>/images/nao.jpg" width="71" height="74" />
                <p class="date">
                	<span>OPENING HOURS</span><br />
					MONDAY- SATURDAY <br />
					09:00AM--21:00PM<br />
                </p>
                <p class="callmsg">Call us to make an appointment or drop by our convenient location in Shanghai &Beijing. </p>
                <p class="dh"><a href="#"><img src="<?php echo theme_url();?>/images/dh.jpg" width="150" height="148" /></a></p>
        	</div>
            <p class="pr"><span>Partenrs:</span>Miracle Mandarin | Miracle Mandarin</p>
            <p class="mo"><a href="#">More</a></p>
        </div>
        <div class="di-nav">
        	<div class="navzong">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Why MM</a></li>
                    <li><a href="#">Chineses Programs</a></li>
                    <li><a href="#">Learn at School</a></li>
                    <li><a href="#">Learm Online</a></li>
                    <li><a href="#">Community</a></li>
                    <li><a href="#">Services</a></li>
                    <li class="none"><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
      <div class="footer">
        	<div class="bottom">
            	<img class="footpic" src="<?php echo theme_url();?>/images/dlogo.jpg" width="270" height="89" />
                <p class="footmsg">
                	Learn Chinese in China, Learn Chinese in Shanghai, Learn Chinese In Beijing<br />
					Learn Chinese in Germany, Cultural Immersion Homestay，Learn Chinese free<br />
					<span>Copyright 2003~2013 ©MiracleMandarin Chinese  Language School.All rights reserved.</span>
                </p>
                <div><img src="<?php echo theme_url();?>/images/hui.jpg" width="40" height="41" /></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
 

</body>
</html>

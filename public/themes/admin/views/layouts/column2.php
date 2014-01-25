
<?php $this->beginContent('//layouts/main'); ?>
<?php if($this->menu){?>
<?php
$d = cache('node__contentfull'); 
if($d){
 
	$i = 1;
	foreach($d as $_k=>$_d){   
		$out[$i]['name'] = __($_d[1]);
		$out[$i]['url'] = 'node/query/index';
		$out[$i]['params'] = array('fid'=>$_k); 
		$i++;
	} 
} 
?>
	<div class="col-lg-3" style="margin-left:0px;padding-left:0px;">
          <div class="bs-sidebar hidden-print affix-top" role="complementary">
        <ul class="nav bs-sidenav">
           
			  <ul class="nav">
			    <?php foreach($out as $v){ $p = array();if($v['params']) $p = $v['params'];
			    ?>
			    <li <?php if(Yii::app()->controller->active=='node-'.$p['fid']){?>
			    	class='active'
			    	<?php }?>><a href="<?php echo url($v['url'],$p);?>">
			    		<?php echo $v['name'];?></a></li>
			    <?php }?>
			  </ul>
		 
           
        </ul>
        	
        <div class="panel panel-primary" style="margin-top:10px;">
	        <div class="panel-heading">
	          <h3 class="panel-title"><?php echo __("action");?></h3>
	        </div>
	        <div class="panel-body">
	          	<?php
	        		$this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu, 
					));
				?>
	        </div>
	      </div>	
         
      </div>
    </div>
        		
	<div class="col-lg-9" style="padding-left:0;">
	 
		<?php echo $content; ?> 
	</div>
<?php }else{?>
	<?php echo $content; ?>
<?php }?>
<?php $this->endContent(); ?>
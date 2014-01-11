<!--###-->
<div id="ajaxContent">
<p><span class=' label label-primary' id='insertImg'><?php echo __('insert image');?></span></p>
<div id="ajax_body" <?php if(!is_ajax()){?>style="display:none;"<?php }?> >	
<?php if($pager->posts){ foreach($pager->posts as $v){?>
		<img src="<?php echo image_url($v['fullpath'],array('resize'=>array(160,120)));?>" 
			rel="<?php echo image_url($v['fullpath'],array('resize'=>array(400,300)));?>"
			/>
		
<?php }}?>	
<div id="ajaxPager">
	<?php
		$this->widget('LinkPager',array('pages'=>$pager->pages));
	?>
</div>
<!--/###-->
 
</div>
</div>

<div id="<?php echo $container;?>">
	<span id="<?php echo $pickfiles;?>" class="clear btn btn-success fileinput-button">
        <i class="icon-plus icon-white"></i>
        <span><?php echo __($info);?></span> 
    </span>

 
	<div id="<?php echo $filelist;?>">
		<?php if($values){
			foreach($values as $v){
				echo FileHelper::input_one($v,$field);
			?> 
		 
		<?php }}?>
	</div> 
	
	<div style='clear:both;'></div>
</div>
<?php
css_code('
.file .icon-remove{
	position: absolute;
	top: 0px;
	right: 0px;
}
.file {
	width: 130px;
	float: left;
	position: relative;
	margin-right: 10px;
	margin-top: 10px;
	margin-bottom: 10px;
}
');	
?>

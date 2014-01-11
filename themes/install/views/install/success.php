

<div class="container">
 <h1 style="width:100%;"><?php echo __('install complate infomation');?></h1>
 	 	<h3><?php echo flash('success');?>
 		
 		<?php echo flash('error');?></h3>
 	 	<p>
 			<?php echo __('Please remove Install Controller');?>
 			<br><code>app/controllers/InstallController.php</code><br>
 			<code>app/models/Install.php</code>
 		</p>
 		<p>
 			<?php echo __('Please remove install view');?> <code>themes/install</code>
 		</p>
		<?php echo __('Visit Admin');?> <a href="<?php echo url('admin/login');?>">Admin </a>
	</p>
	
</div>

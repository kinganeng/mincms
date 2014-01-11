<blockquote>
	<h3>
		<?php echo __('app modules');?>   
	</h3>
</blockquote>
<?php if($data){?>
<table class="table table-striped table-bordered table-condensed">
  <tr>
	<td><?php echo __('name'); ?></td> 
	<td><?php echo __('install'); ?></td> 
  </tr>
  <?php  
  foreach($data as $post){  
  ?>
  <tr>
	<td><blockquote><?php echo $post['name']; ?>  [<?php echo $post['info']['memo']; ?>]
	  <small><?php echo $post['path']; ?></small>
	  </blockquote></td>
  
	<td  class="<?php echo 'show_'.$post['name'];?>"> 
	    <?php if(!in_array($post['name'],$core)){?>
			<?php if($post['active'] == 1){?>  
				<span class="label label-success">
					<a class='ajax_add hander'  href="<?php echo url('admin/module/install',array(
					'id'=>$post['name']));?>" rel=1 id="<?php echo $post['name'];?>"><i class="glyphicon glyphicon-trash glyphicon-white"></i></a> </span>
			<?php }else{?>
			<a class='ajax_add hander' id="<?php echo $post['name'];?>" 
				href="<?php echo url('admin/module/install',array('id'=>$post['name']));?>">
				<i class="glyphicon glyphicon-plus"></i></a>
			<?php }?>
	 	<?php }else{?>
	 		<span class="glyphicon glyphicon-lock"></span>
	 	<?php }?>
	</td>
   
  </tr>
   
  
  <?php } ?>
</table> 
<?php }?>

 

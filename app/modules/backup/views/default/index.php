<blockquote><h3><?php echo __('restore database');?></h3></blockquote>
	
<a class='btn btn-primary ' href="<?php echo url('backup/default/do',array('id'=>'store'));?>">
	<?php echo __('backup');?>
</a>
<p>	</p>
<?php if($rows){?>
<table class="table table-bordered">
<thead>
<tr>
<th><?php echo __('name');?></th>
<th><?php echo __('file time');?></th>
<!--<th><?php echo __('restore');?></th>-->
</tr>
</thead>
<tbody>
<?php foreach($rows as $vo=>$time){?>
<tr>
<td><?php echo $vo;?>&nbsp;&nbsp;[<?php echo FileHelper::size(base_path().'/../data/'.$vo);?>]</td>
<td><?php echo date('Y-m-d H:i:s',$time);?></td>
<!--<td><a class='btn btn-primary '  href="<?php echo url('backup/default/do',array('id'=>'restore','file'=>base64_encode($vo)));?>"><?php echo __('restore');?></a></td>
-->
</tr>
<?php }?>
</tbody>
</table>
<?php }?>
<div class="alert alert-success">
     <strong><?php echo __('file');?>:</strong>  <?php echo $name;?>
</div>
<p><span class="label label-info"><?php echo __('path');?>:</span></p>
<?php if($urlpath){?>	
	<ol class="breadcrumb">
	  <?php foreach( $urlpath as $v ){  
	  ?>	
	  <li><?php echo $v;?></li>
 	  <?php }?>	
	</ol>
<?php }?>
	
<?php $this->renderPartial('dir',array(
'listDir'=>$listDir,	
));?>
<?php if($listFile){?>
<div class="panel panel-default">  
    <div class="panel-heading"><?php echo __('file');?></div> 
     <table class="table">
      <thead>
        <tr>
          <th><?php echo __('name');?></th>
          <th><?php echo __('size');?></th>
          <th><?php echo __('modify time');?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
    	<?php foreach($listFile as $k=>$v){?>
        <tr>
          <td>
            <?php if($v['img'] === true){?>
            	<a class="fancybox" rel="group" href="<?php echo $k;?>">
            <?php }?>
            <?php echo $v['name'];?>
            
            </a>
            
            </td>
          <td><?php echo $v['size'];?></td>
          <td><?php echo $v['time'];?></td>
          <td><?php if($v['img'] === true) echo image($k,array('resize'=>array(54,40)));?></td>
        </tr>
       <?php }?> 
      </tbody>
    </table>
</div>
<?php
widget('fancybox',array(
		  'tag'=>'.fancybox',
	  ));		  
 }?>
		  
		  
	
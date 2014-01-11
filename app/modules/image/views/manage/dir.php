<?php if($listDir){?>
<div class="panel panel-default">  
    <div class="panel-heading"><?php echo __('folders');?></div> 
     <table class="table">
      <thead>
        <tr>
          <th><?php echo __('name');?></th> 
          <th><?php echo __('modify time');?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
    	<?php foreach($listDir as $k=>$v){?>
        <tr>
          <td>
            
            <a  href="<?php echo url('image/manage/index',array('file_id'=>base64_encode(($v['fullDir']))));?>">
            <?php echo $v['name'];?>
            </a>
            
            </td>
           <td><?php echo $v['time'];?></td>
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
		  
		  
	
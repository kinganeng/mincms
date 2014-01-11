<?php 
if(is_array($indexUrl)){	
	$indexUrl[1]['id'] = $v['id'];
	$indexUrl =  url($indexUrl[0],$indexUrl[1]);  
}
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

"); 
?> 
<?php if($search){?>  
	<?php echo CHtml::link(__('<span class="glyphicon glyphicon-search"></span>'),'#',array('class'=>'search-button')); ?>
	<div class="search-form" <?php if(!$_GET){?>style="display:none"<?php }?>>
	<?php $this->render('BuilderIndexSearch',array(
		'model'=>$model,
		'row'=>$row,
		'table'=>$table,
		'indexUrl'=>$indexUrl,
	)); ?>
	</div><!-- search-form -->
<?php }?>
<?php
if(true === $uisort)
		$form=$this->beginWidget('CActiveForm',array('id'=>$sortId)); 
?>
<table class="table table-bordered table-hover tablesorter">
	<thead>
		<tr>
			<th>#</th>
			<?php 
				foreach($row as $name=>$r){ 
					if(true === $r['index']){
			?>
			<th><?php echo __($name);?></th>
			<?php 
					}
				}
			?>
			<?php if($show===true){?>
			<th><span class="glyphicon glyphicon-wrench"></span></th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($posts as $v){  ?>
		<tr>
			<td><?php echo $v['id'];?></td>
			<?php 
				foreach($row as $name=>$r){ 
					if(true === $r['index']){
			?>
			<td> <?php 
			if($r['_value']){
				if(strpos($r['_value'],'php:')!==false){
					$fun = substr($r['_value'],4);
					if(strpos($fun,'::')!==false){
						$aa = explode('::',$fun); 
						echo call_user_func($aa[0] ."::".$aa[1],$v); 
					 
					}elseif(strpos($fun,'->')!==false){
						$aa = explode('->',$fun); 
						$obj = new $aa[0];
						echo $obj->$aa[1]($v); 
					 
					}else{
						echo $fun ( $v);
					}
				}else{
					echo $r['_value'].$v[$name];
				}
			}else{
				echo $v[$name];
			}	
			?> </td> 
			<?php 
					}
				}
			?>
			<?php if($show===true){ 
					if(is_array($editUrl)){
				 		$editUrl[1]['id'] = $v['id'];
						$EURL =  url($editUrl[0],$editUrl[1]);  
					}
					if(is_array($deleteUrl)){
						$deleteUrl[1]['id'] = $v['id'];
						$deleteUrl[1]['name'] = encode($table);
						$DURL =  url($deleteUrl[0],$deleteUrl[1]); 
					} 

				?>
			<td>
				<a href="<?php echo $EURL;?>" style="margin-right:15px;">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				 
				<a href="<?php echo $DURL;?>">
				 
					<?php if($v['display']==1){?>
						<span class="glyphicon glyphicon-ok"></span>
					<?php }else{?>
						<span class="glyphicon glyphicon-remove" style="color:red"></span>	
					<?php }?>
				</a>
					
				<?php if($action){ foreach($action as $a=>$t)?>
					<a href="<?php echo url($t,array('id'=>$v['id']));?>" style="margin-left:15px;"><?php echo __($a);?></a>
				<?php }?>
			</td>
			<?php }?>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php if(true === $uisort) $this->endWidget(); ?>	
<?php 
$this->widget('LinkPager',array('pages'=>$pages));
?>
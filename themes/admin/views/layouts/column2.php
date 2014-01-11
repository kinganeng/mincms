
<?php $this->beginContent('//layouts/main'); ?>
<?php if($this->menu){?>
	<div class="col-lg-10" style="padding-left:0;">
	 
		<?php echo $content; ?>
		 
	</div>
	<div class="col-lg-2">
		<div id="sidebar">
		<div class="panel panel-primary">
	      <div class="panel-heading">
	        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php echo __('operations');?></h3>
	      </div>
	      <div class="panel-body">
	        <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>"",
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
	      </div>
	    </div>

		
	 
	</div>
<?php }else{?>
	<?php echo $content; ?>
<?php }?>
<?php $this->endContent(); ?>
 <?php $menus = menu_function::admin();
        foreach($menus as $v){    
        	 
        	
        ?>
        	<?php if($v['datas']){?>
	        	<li class="dropdown <?php if(Helper::activeMenu(substr($v['url'],0,strrpos($v['url'],'/')))){?>
		        		active<?php }?>" >
				              <a   class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-dashboard"></i><?php echo __($v['name']);?> <b class="caret"></b></a>
				              <ul class="dropdown-menu">
				              <?php foreach($v['datas'] as $vo){
				              	if(!$vo['params']) $vo['params'] = array();	  
				              ?>	  
				               <li <?php if(Helper::activeMenu(substr($vo['url'],0,strrpos($vo['url'],'/')))){?>
						        		class="active"<?php }?> >
						        		<a href="<?php echo url($vo['url'],$vo['params']);?>">
						        			<i class="fa fa-dashboard"></i><?php echo __($vo['name']);?>
						        		</a>
						        </li>	
				               <?php }?> 
				              </ul>
				            </li> 
	        <?php }else{?>
	        	<li <?php if(Helper::activeMenu(substr($v['url'],0,strrpos($v['url'],'/')))){?>
		        		class="active"<?php }?> >
		        		<a href="<?php echo url($v['url']);?>">
		        			<i class="fa fa-dashboard"></i><?php echo __($v['name']);?>
		        		</a>
		        </li>	
	        <?php }?>
        <?php }?>
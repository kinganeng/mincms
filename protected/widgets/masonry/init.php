<?php  
/**
* masonry widget
*
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses
* @link http://mincms.com/demo-masonry.html masonry demo
* @link http://mincms.com/demo-scroll.html scroll demo
* @author Sun 
* @email  68103403@qq.com 
*/

class Widgets_Masonry_Init extends CWidget
{  
	/**
	* html element, such as #id .class
	*/
 	public $tag; 
 	/**
 	* array options
 	*/
 	public $options; 
 	/**
 	* if scroll ajax_load.gif position
 	*/
 	public $bottom = true;
 	/**
 	* item
 	*/
 	public $itemSelector = '.item';
 	/**
 	* scroll  true/false
 	*/
 	public $scroll = false; 
 	/**
 	* css  true/false
 	*/
 	public $css = true; 
 	/**
	* masonry/scroll images
	*
	* Example masonry:
	*  
	* <code> 
	* <?php
	*	widget('masonry' , array('tag'=>'#masonry'));
	*	css("
	*		#masonry li{ 
	*			list-style:none; 
	*			float:left;
	*			margin-rigth:10px;
	*		}
	*	");
	* ?>
	* <div id='masonry'>
	*	 <ul>
	*	 <?php for($j=1;$j<=50;$j++){?>
	*	 	<?php for($i=1;$i<=6;$i++){?>
	*		 	<li class='item'>
	*		 		<?php echo image("upload/t/{$i}.jpg" , array( 'resize' => array(120)));?>
	*		 	</li>
	*	 	<?php }?>
	*	 <?php }?>
	*	 </ul> 
	* </div>
	* </code>  
	* Example scroll:
	* <code>
	*	<?php 
	*	$data = \application\core\DB::pagination('file');
	*	$count = $data->pages->itemCount;
	*	$size = $data->pages->pageSize;
	*	$models = $data->models;  
	*	widget('masonry' , array(
	*		'tag'=>'#masonry',
	*		'scroll'=>true
	*	));
	*	css("
	*		#masonry li{ 
	*			list-style:none; 
	*			float:left;
	*			margin-rigth:10px;
	*		}
	*	");
	*	 ?>
	*	 <div id='masonry'>
	*		 <ul> 
	*		 	<?php foreach($models as $v){?>
	*			 	<li class='item'>
	*			 		<?php echo image($v['path'] , array( 'resize' => array(120)));?>
	*			 	</li>
	*		 	<?php }?> 
	*		 </ul> 
	*	</div>
	*</code> 
	*
	* Example scroll 2:
	*
	* <code>
	*	use application\core\Pagination;
	*	$size = 20;
	*	$arr = Pagination::img($post->img , $size); 
	*	$models = $arr['models'];
	*	$pages = $arr['pages'];
	*	$count = $arr['count']; 
   *	echo \application\core\Pagination::next($count,$size);
	* </code>
	*/

	function run(){   
		core_js('jquery');
		$base = publish(dirname(__FILE__).'/assets');  
 		$tag = $this->tag; 
		$bottom = $this->bottom?$this->bottom:true; 
		$itemSelector = $this->itemSelector?$this->itemSelector:'.item';
		if(!$this->options['itemSelector'])
	 		$this->options['itemSelector'] = $itemSelector;
		$opts = CJavaScript::encode($this->options);  
		
		if($this->scroll === true){ 
			if(true === $this->css)
				css_code("
				#infscr-loading div{} 
						#infscr-loading{clear:both; position: absolute;padding-left:10px;
						bottom: -25px;width: 200px;}#infscr-loading img{float: left;margin-right: 5px;}");
			if(!$this->options['loading']['img'])
	 			$this->options['loading']['img'] = $base."/ajax-loader.gif";
	 		if(!$this->options['loading']['msgText'])
	 			$this->options['loading']['msgText'] = __('loading content……');
	 		if(!$this->options['loading']['finishedMsg'])
	 			$this->options['loading']['finishedMsg'] = __('it is over');
	 		
	 		if(!$this->options['dataType'])
	 			$this->options['dataType'] = 'html';
	 		if(!$this->options['navSelector'])
	 			$this->options['navSelector'] = 'div.pagination';
	 		if(!$this->options['nextSelector'])
	 			$this->options['nextSelector'] = 'div.pagination a';
	 		if(!$this->options['itemSelector'])
	 			$this->options['itemSelector'] = $itemSelector;
	 		$infinitescrollOpts = CJavaScript::encode($this->options);  
	 		widget("imagesloaded",array('tag'=>null));	
		 	js_code("
				var \$container = $('".$tag."');
		 		\$container.imagesLoaded(function(){
			     \$container.masonry($opts);
			    });   
				var \$container = $('".$tag."');
					\$container.infinitescroll(".$infinitescrollOpts.",  
				  function( newElements ) { 
				    var \$newElems = $( newElements ).css({ opacity: 0 });
			        \$newElems.imagesLoaded(function(){
			          \$newElems.animate({ opacity: 1 });
			          \$container.masonry( 'applicationended', \$newElems, true ); 
			        });

				  }
				); 
			"); 
			js($base.'/jquery.infinitescroll.js');
		}else{
			js_code("
				var \$container = $('".$tag."');
		 		\$container.imagesLoaded(function(){
			     \$container.masonry($opts);
			    });  
			"); 
		
		}
		js($base.'/jquery.masonry.min.js');
		js($base.'/jquery.imagesloaded.min.js'); 
	}
}
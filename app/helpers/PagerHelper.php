<?php   
// +----------------------------------------------------------------------
// | PagerHelper
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

/**
	$result = CDB()->from('album_images');
	$posts = CDB()->from('album_images');
	$pager = new PagerHelper($result,$posts);
	$pager = $pager->run();

	<?php if($pager->posts){ foreach($pager->posts as $v){?>
			<?php echo $v['id'];?>
			
	<?php }}?>	
	$this->widget('LinkPager',array('pages'=>$pager->pages));
*/ 
class PagerHelper  
{ 
	public $pageSize = 10;
	public $pages;
	public $posts;
	protected $criteria;
	protected $result;
 	
	function __construct($result,$posts){
	 
		$this->criteria =  new CDbCriteria();  
		$this->result   =   $result;
	    $this->posts =  $posts;
	} 
 
	function run(){
		if(!$this->result) return;
		
		$this->result   = $this->result->query();
		$this->pages    =  new CPagination($this->result->rowCount); 
	    $this->pages->pageSize = $this->pageSize ;
	    $this->pages->applyLimit($this->criteria);   
	    $this->posts = $this->posts->limit($this->pages->pageSize);
	    $this->posts = $this->posts->offset($this->pages->currentPage*$this->pages->pageSize); 
	    $this->posts = $this->posts->query();   
	    return $this;
	}
	/**
	* 配合 masonry 这个 widget
	* 
	widget('masonry' , array(
		'tag'=>'#masonry',
		'scroll'=>true
	));
	*/
	function next(){
		$count = $this->result->rowCount;
		$size = $this->pageSize;
		$page = (int)$_GET['page']?:1;
		$next = $page+1; 
		$pages = ceil($count/$size);
		if($page<=$pages){
			$params = array('page'=>$next);
			if($_GET){
				$params = array_merge($_GET,$params);
			}
			$url = url_action(null,$params); 
			echo "<div   class='pagination' style='display:none;'><a href='".$url."'></a></div>";
		}else{
			throw new \Exception('exception');
		}
	}
	
	 
}
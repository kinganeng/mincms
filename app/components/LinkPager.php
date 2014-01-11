<?php
// +----------------------------------------------------------------------
// | ·ÖÒ³
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class LinkPager extends CLinkPager
{  
	public $htmlOptions = array('class'=>'pagination');
	public $header = false; 
	public $cssFile = false;
	public $selectedPageCssClass = 'active';
	public $nextPageLabel = '&raquo;';
	public $prevPageLabel = '&laquo;';
  	public $hiddenPageCssClass = "disabled";


	protected function createPageButtons()
	{
	    if(($pageCount=$this->getPageCount())<=1)
	        return array(); 
	    list($beginPage,$endPage)=$this->getPageRange();
	    $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
	    $buttons=array(); 
	    // prev page
	    if(($page=$currentPage-1)<0)
	        $page=0;
	    $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

	    // internal pages
	    for($i=$beginPage;$i<=$endPage;++$i)
	        $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

	    // next page
	    if(($page=$currentPage+1)>=$pageCount-1)
	        $page=$pageCount-1;
	    $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

 	 
	    return $buttons;
	}

 

 
 
 
}

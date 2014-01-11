<?php
// +----------------------------------------------------------------------
// | MiniFy  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

 
class ClientScript extends CClientScript
{ 
	public $minifyHtml = false;
	
	public function render(&$output)
	{ 
		if(true == $this->minifyHtml){
			$output = preg_replace(array('/ {2,}/','/<!--.*?-->|\t|(?:\r?\n[\t]*)+/s'),array(' ',''),$output); 
		}
	    if(!$this->hasScripts)
	        return;

	    $this->renderCoreScripts();

	    if(!empty($this->scriptMap))
	        $this->remapScripts();

	    $this->unifyScripts();

	    $this->renderHead($output);
	    if($this->enableJavaScript)
	    {
	        $this->renderBodyBegin($output);
	        $this->renderBodyEnd($output);
	    }
	}

	 
}

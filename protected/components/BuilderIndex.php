<?php
// +----------------------------------------------------------------------
// | 自动化操作数据库  
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

 
class BuilderIndex extends BuilderView{
	public $save = false; 
	public $pageSize = 10;
	public $edit = true;
	public $delete = true;
	public $editUrl;
	public $deleteUrl;
	public $uisort = false;
	public $uisortUrl;
	public $indexUrl;
	public $action = array();
	public $search;
	public $sortId = 'sort';
	/**
	* 对于db类的更多方法
	* 这是方法()
	*/
	public $function = array( "order"=>'id desc');
	/**
	* 这是 =  
	*/
	public $functiond = array();
	function run(){  
	 	parent::run(); 
	 	foreach($this->row as $k=>$v){
	 		if($v['search'])
	 			$this->search = true;
	 	}
	 	if(true === $this->uisort){
	 		if(!$this->uisortUrl)
	    		$this->uisortUrl = url($this->controller->module->id.'/'.$this->controller->id.'/sort');
		 	UiHelper::sort('#sort',$this->uisortUrl);  
		 	if(!$this->function['order'])
				$this->function['order'] = "sort desc,id desc"; 
		} 
	 	$criteria =  new CDbCriteria();
	    $result   =  Yii::app()->db->createCommand()->from($this->table);
	    $posts = Yii::app()->db->createCommand()->from($this->table); 
	    $where = $_GET['AutoModel'];
	    $result = $result->andWhere("1 = 1" );
	    $posts = $posts->andWhere("1 = 1" );
	    if($where){
	    	foreach($where as $k=>$v){ 
	    		if(!$v) continue;
	    		$this->model->$k = $v;
	    		$result = $result->andWhere("$k=:$k",array(":$k"=>trim($v)) );
	    		$posts = $posts->andWhere("$k=:$k",array(":$k"=>trim($v)) );
	    	} 
	    }  
	    if($this->function){
	    	foreach($this->function as $k=>$v){  
	    		$result = $result->$k( $v );
	    		$posts = $posts->$k( $v );
	    	}
	    }
	    if($this->functiond){
	    	foreach($this->functiond as $k=>$v){
	    		$result = $result->$k = $v ;
	    		$posts = $posts->$k = $v ;
	    	}
	    } 
	    $result   = $result->query();
	    $pages    =  new CPagination($result->rowCount); 
	    $pages->pageSize = $this->pageSize ;
	    $pages->applyLimit($criteria);   
	    $posts = $posts->limit($pages->pageSize);
	    $posts = $posts->offset($pages->currentPage*$pages->pageSize); 
	    $posts = $posts->query();   
	    $show  = false;
	    if($this->edit === true || $this->delete === true){
	    	$show  = true;
	    }
	    if(!$this->editUrl){
	    	$this->editUrl = array(
	    		$this->controller->module->id.'/'.$this->controller->id.'/update',
	    	 	array("id"=>'{id}') 
	    	);
	    }
	    if(!$this->deleteUrl){
	    	$this->deleteUrl = array(
	    		$this->controller->module->id.'/'.$this->controller->id.'/delete',
	    		array("id"=>'{id}','table'=>'{table}') 
	    	);
	    }
	    if(!$this->indexUrl){
	    	$this->indexUrl =  url($this->controller->module->id.'/'.$this->controller->id.'/index');
 	    }
	    $this->render('BuilderIndex', array(
	    	 'posts' => $posts,
	         'pages' => $pages,
	         'row'  =>$this->row,
	         'show' => $show,
	         'editUrl' =>$this->editUrl,
	         'deleteUrl' =>$this->deleteUrl,
	         'uisort'=>$this->uisort,
	         'model'=>$this->model,
	         'table'=>$this->table,
	         'indexUrl'=>$this->indexUrl,
	         'action'=>$this->action,
	         'search'=>$this->search,
	         'sortId'=>$this->sortId,
	    ));
	 	
	 	 
	}
	
 	
}
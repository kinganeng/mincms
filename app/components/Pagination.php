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
class Pagination  
{  
	/**
	* ajax pagination
	* <code>
	* \Pagination::ajax('.ajax_pagination a' , '#ajax_body');
	* </code>
	*/
	static function ajax($tag = '.ajax_pagination a',$body = '#ajax_body'){
		js("
			$('".$tag."').click(function(){
			var url = $(this).attr('href');
			$.post(url,function(data){
				$('".$body."').html(data);
			});
			return false;
		});
		");
	}
	/**
	* support ckeditor pagebreak
	$node = node('post',1); 
 	$data = \Pagination::innerPager($node->body);
 		
	<?php echo $row;?>
	<?php echo $pages;?>
	*
	*/
	static function innerPager($str,$pagerbar=null, $class='pagination'){
		if(!$pagerbar)
			$pagerbar = '<div style="page-break-after: always;"><span style="display:none">&nbsp;</span></div>';
		$arr = explode($pagerbar,$str);
		$page = count($arr);
		$p = (int)$_GET['page']?:1;
		$pages = "<div class='".$class."'>";
		$pages .= "<ul>";
	 
		for($i=1;$i<=$page;$i++){
			unset($cls);
			unset($_GET['page']);
			$params = array('page'=>$i);
			if($_GET){
				$params = array_merge($_GET,$params);
			}
			$url = url_action(null,$params);
			if($i==$p)
				$cls = "class='active'";
			$pages .= "<li  $cls ><a href='".$url."'>".$i."</a></li>";
		}
		$pages .= "</ul></div>";
		$row = $arr[$p-1]?:false;
		if($p>$page) return;
		return array('row'=>$row,'pages'=>$pages);
	}
	/**
	* 
	*/
	static function next($count,$size=10){
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
 
	/**
	* image pagination
	*
	* Example
	*
 	* <code>
	* 	$arr = Pagination::img($post->img , $size); 
	*	$models = $arr['models'];
	*	$pages = $arr['pages'];
	*	$count = $arr['count'];
 	* </code> 
	*/
	static function img($arr,$per=2,$img=false, $class='pagination'){	 
		$current = (int)$_GET['page']?:1;
		$top = $current_page-1>0?:1;
		$next = $current_page+1;
		$num = count($arr);
		$page =  ceil($num/$per); 
		if($current>=$page)
			$current = $page;
 		$k=$i = ($current-1) * $per; 
	 	$j = $i+$per;
	 	if($j>= $num) $j = $num;
		foreach($arr as $k=>$v){
			$n[] = $v;	  
		} 
		for($i;$i<$j;$i++){
			$post[] = $n[$i];
		}
	 	$p = "<div class='".$class."'><ul>";
		for($i=1;$i<=$page;$i++){
			unset($cls);
			$params = array('page'=>$i);
			if($_GET){
				$params = array_merge($_GET,$params);
			}
			$url = url_action(null,$params); 
			
			if($i==$current)
				$cls = "class='active'";
			if($img==true){
				$p .= "<li $cls><a href='".$url."'    data-content=\"<img src='".image($n[($i-1)*$per],array(400,300))."'/>\" >".$i."</a></li>";
			}
			else 
				$p .= "<li $cls><a href='".$url."' $cls >".$i."</a></li>";
		}
		$p .= "</ul></div>";
		return array('models'=>$post,'pages'=>$p ,'count'=>$num);
	}
	/**
	*   Pagination 
	* 
	*	Controller:
	*   <code>
	*	$rt = \Pagination::run('\application\modules\core\models\Config');  
	*	return $this->render('index', array(
	*	   'models' => $rt->models,
	*	   'pages' => $rt->pages,
	*	));
	*	View:
	*	echo application\core\widget\Table::widget(array(
	*		'models'=>$models,
	*		'pages'=>$pages,
	*		'fields'=>array('slug','memo')	,
	*		'title'=>__('do you want remove config')
	*	));
	* </code>
	*/ 
	static function run($model,$criterias=array(),$pageSize=10){ 
		$criteria = new CDbCriteria();  
		if($criterias){  
        	foreach($criterias as $k=>$v){
        		$criteria->$k = $v;        
        	}
        } 
        $count = $model::model()->count($criteria);  
        $pager = new CPagination($count);    
        $pager->pageSize = $pageSize;             
        $pager->applyLimit($criteria);   
        $models = $model::model()->findAll($criteria);    
 		return (object)array(
			'pages'=>$pages,
			'models'=>$models
		);
	}
}
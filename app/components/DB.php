<?php  
// +----------------------------------------------------------------------
// | 数据库操作
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class DB{

	static function sql($sql=null){
		return \Yii::app()->db->createCommand($sql);

	}
	static function queryAll($sql){
		return static::queryRow($sql,true);
	}
	
	static function queryOne($sql){
		return static::queryRow($sql);
	}
	static function queryRow($sql,$flag=false){
		$command = \Yii::app()->db->createCommand($sql);
		if(false === $flag)
			return $command->queryOne();
		return $command->queryAll();
	}
	static function one($table,$getway=array()){
		$command = static::_query($table,$getway);
		return $command->queryOne(); 
	}
	static function all($table,$getway=array()){
		$command = static::_query($table,$getway); 
		return $command->queryAll();  
	}
	
	static function insert($table,$data=array()){ 
		return \Yii::app()->db->createCommand()
			->insert($table,$data)->execute();   	
	}
	static function batchInsert($table, $columns, $rows){ 
		return \Yii::app()->db->createCommand()
			->batchInsert($table, $columns, $rows)->execute();   	
	}
	static function id(){ 
		return \Yii::app()->db->getLastInsertID();
	}
	 
	/**
	* DB pagination
	*
	* Example  
	* <code>
	*   $data = \application\core\DB::pagination('file');
	*	return $this->render('test',$data);
	*	foreach($models as $v){	
	*	}
	*	<div class='pagination'>
	*	<?php  echo \application\core\LinkPager::widget(array(
	*	      'pagination' => $pages,
	*	  ));?>
	*	</div>
	* </code>
	*/
	static function pager($table,$where=array(),$function=array(),$functiond=array(),$pageSize=10){
		$criteria =  new CDbCriteria();
	    $result   =  Yii::app()->db->createCommand()->from($table);
	    $posts = Yii::app()->db->createCommand()->from($table); 
	    $where = $_GET['AutoModel'];
	    $result = $result->andWhere("1 = 1" );
	    $posts = $posts->andWhere("1 = 1" );
	    if($where){
	    	foreach($where as $k=>$v){ 
	    		if(!$v) continue;
	    		$result = $result->andWhere("$k=:$k",array(":$k"=>trim($v)) );
	    		$posts = $posts->andWhere("$k=:$k",array(":$k"=>trim($v)) );
	    	} 
	    }  
	    if($function){
	    	foreach($function as $k=>$v){  
	    		$result = $result->$k( $v );
	    		$posts = $posts->$k( $v );
	    	}
	    }
	    if($functiond){
	    	foreach($functiond as $k=>$v){
	    		$result = $result->$k = $v ;
	    		$posts = $posts->$k = $v ;
	    	}
	    } 
	    $result   = $result->query();
	    $pages    =  new CPagination($result->rowCount); 
	    $pages->pageSize = $pageSize?:10 ;
	    $pages->applyLimit($criteria);   
	    $posts = $posts->limit($pages->pageSize);
	    $posts = $posts->offset($pages->currentPage*$pages->pageSize); 
	    $posts = $posts->query();    
     	return (object)array(
			'pages'=>$pages,
			'posts'=>$posts
		);
	}
	
	/**
	*  
	* 其中$condition
	* <code>
	* array(
	* 	'id=:id',
	*		array( ':id'=>$node_id)
	* ))
	* </code>
	*/
	static function update($table, $columns, $condition = '', $params = array()){ 
		return \Yii::app()->db->createCommand()
			->update($table,$columns,$condition,$params)->execute();   	
	}
	static function delete($table, $condition = '', $params = array()){ 
		return \Yii::app()->db->createCommand()
			->delete($table, $condition , $params)->execute();   		
	}
	static function query($sql){
		return \Yii::app()->db->createCommand($sql)->execute();
	}
	static function _query($table,$getway=array()){  
		$query = \Yii::app()->db->createCommand($sql);

		$query = $query->from($table);
		if($getway){
			foreach ($getway as $key => $value) {
				$query = $query->$key($value); 
			}
		} 
		return $query;  
	}
}

http://www.yiiframework.com/doc/api/1.1/CDbCriteria

	$criteria =  new CDbCriteria();
	$criteria->condition = "id = 1 or id =1";
	$row = Node::pager('post',$criteria);
	$pages = $row['pages'];
	$posts = $row['posts'];
	$this->widget('CLinkPager',$pages);  


	$criteria =  new CDbCriteria();
	$criteria->condition = "id = 1 or id =1";
	$node = Node::find('post',$criteria); 
	Node::find('post',1); 




	$criteria = new CDbCriteria;   
	//select  
	$criteria->select = '*';//默认*  
	$criteria->select = 'id,name';//指定的字段  
	$criteria->select = 't.*,t.id,t.name';//连接查询时，第一个表as t,所以用t.*  
	$criteria->distinct = FALSE; //是否唯一查询   
	  
	  
	//join  
	$criteria->join = 'left join table2 t2 on(t.id=t2.tid)'; //连接表    
	$criteria->with = 'xxx'; //调用relations    
	  
	  
	//where 查询数字字段  
	$criteria->addCondition("id=1"); //查询条件，即where id = 1    
	$criteria->addBetweenCondition('id', 1, 4);//between 1 and 4       
	$criteria->addInCondition('id', array(1,2,3,4,5)); //代表where id IN (1,23,,4,5,);    
	$criteria->addNotInCondition('id', array(1,2,3,4,5));//与上面正好相法，是NOT IN  
	  
	  
	//where 查询字符串字段  
	$criteria->addSearchCondition('name', '分类');//搜索条件，其实代表了。。where name like '%分类%'   
	   
	//where 查询日期字段  
	$criteria->addCondition("create_time>'2012-11-29 00:00:00'");  
	$criteria->addCondition("create_time<'2012-11-30 00:00:00'");  
	  
	  
	//where and or  
	$criteria->addCondition('id=1','OR');//这是OR条件，多个条件的时候，该条件是OR而非AND    
	  
	  
	//这个方法比较特殊，他会根据你的参数自动处理成addCondition或者addInCondition，  
	//即如果第二个参数是数组就会调用addInCondition    
	  
	  
	$criteria->compare('id', 1);      
	/**  * 传递参数 */    
	  
	  
	$criteria->addCondition("id = :id");    
	$criteria->params[':id']=1;    
	  
	  
	//order   
	$criteria->order = 'xxx DESC,XXX ASC' ;//排序条件    
	  
	  
	//group  
	$criteria->group = 'group 条件';    
	$criteria->having = 'having 条件 '
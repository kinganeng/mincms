<?php
class menu_function{
	/**
	* 后台菜单
	<?php $menus = menu_function::admin();
        foreach($menus as $v){ 
        ?>
	        <li <?php if(Helper::activeMenu(substr($v->url,0,strrpos($v->url,'/')))){?>
	        		class="active"<?php }?> >
	        		<a href="<?php echo url($v->url);?>">
	        			<i class="fa fa-dashboard"></i><?php echo __($v->name);?>
	        		</a>
	        </li>
        <?php }?>
	*/
	static function admin(){  
		if(!cache('menus')){ 
			cache('menus' , self::menu() );
		} 
		return cache('menus');
	}
 
	/**
	* 取得后台菜单数组
	*/
	static function menu(){
	 
	 
		$pid = 0;
		$rows = Yii::app()->db->createCommand()->from('menus')
				->where("is_admin=1 AND display = 1 AND pid=$pid")
				->order("sort desc,id desc")
				->queryAll();
		foreach($rows as $v){
				$query = Yii::app()->db->createCommand()
					->from('menus')
					->where("is_admin=1 AND display = 1 AND pid=".$v['id'])
					->order("sort desc,id desc")
					->queryAll();
				$data[$v['id']] = $v;
				if($query){ 
					$data[$v['id']]['datas'] = $query;
				} 
		}
		return $data;
	}

}
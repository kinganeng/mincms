<?php
// +----------------------------------------------------------------------
// | 图片 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class ImageController extends AdminController
{
	public $active = "album.default";
	public $layout='//layouts/column2';
	
 
	public function actionIndex()
	{ 
		$id = (int)$_GET['id'];	
		if($id<1){
			flash('error',__('error'));
			$this->redirect(url('album/default/index'));
		} 
		$row = CDB()->from('albums')
					->where('id=:id',array(':id'=>$id))
					->queryRow();
		
		if($_POST['file']){
			$id = $_POST['id'];
			if($id>0){
				foreach($_POST['file'] as $fid){
					if($fid<1) continue;
					$data['album_id'] = $id;
					$data['fid'] = $fid;
					Yii::app()->db->createCommand()->insert('album_images',$data);
				}
			}
			flash('success',__('success'));
			$this->refresh();
		}
		// result
		$result = CDB()->from('album_images')
					->where('album_id=:album_id',array(':album_id'=>$id))
					->order('sort desc,id desc');
		$posts = CDB()->from('album_images')
					->where('album_id=:album_id',array(':album_id'=>$id))
				    ->order('sort desc,id desc');
		$pager = new PagerHelper($result,$posts);
		$pager->pageSize = 30;
		$pager = $pager->run();
		$this->render('index',array(
			'id'=>$id,
			'pager'=>$pager,
			'row'=>$row,
		));
	}
 
	
	public function actionSort(){ 
 		$ids = $sort = $_POST['ids'];  
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "album_images";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	CDB()->update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}    
 		return 1; 
	}
}
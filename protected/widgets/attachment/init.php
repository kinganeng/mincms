<?php  
/**
* 
<?php
widget("attachment",array(
	 
)); 
?>

<textarea id='a' name='a'>tgest</textarea>
* 
* @author Sun 
* @email  68103403@qq.com 
*/
class Widgets_Attachment_Init extends CWidget
{  
 	public $tag = 'ckeditor'; 
	function run(){   
		$result = CDB()->from('attachments');
		$posts = CDB()->from('attachments');
		$pager = new PagerHelper($result,$posts);
		$pager->pageSize = 5;
		$pager = $pager->run(); 
		
		if(true===Yii::app()->request->isAjaxRequest){
			Yii::app()->controller->layout = false;
		}
 	 
		
		js_code("
			function ajax_body_insert(){
				$('#ajax_body img').click(function(){  
					var rel = $(this).attr('rel'); 
					".$this->tag.".insertHtml('<img src='+rel+' />');
					$('#ajax_body #up').fadeIn().fadeOut(2000);
				}); 
			}
			ajax_body_insert();
			function ajaxPager(){
				$('#ajaxPager a').click(function(){ 
					var url = $(this).attr('href'); 
					$.post(url,function(data){ 
						data = substr(data,strpos(data,'<!--###-->')); 
						data = substr(data,0,strpos(data,'<!--/###-->')); 
						$('#ajaxContent').html(data); 
						ajaxPager();  
						insertImg();
						ajax_body_insert();
					});
					
					return false;
				});
			}
			ajaxPager();
			function insertImg(){
				$('#insertImg').click(function(){ 
					if($('#ajax_body').css('display')=='none')
				    	$('#ajax_body').show();
				    else
				    	$('#ajax_body').hide();
				 });
			}
			insertImg();
			");

 	   $this->render('index',array(
 	   	'pager'=>$pager
 	   ));
	}
}
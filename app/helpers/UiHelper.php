<?php  
// +----------------------------------------------------------------------
// | Ui
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class UiHelper
{ 
   static function ajax($url,$data=array(),$replace,$js=null){ 
   	   if($data)
   	   		$query = CJavaScript::encode($data); 
   	   $script = "
	   	   $.post('".$url."',".$query.",function(data){
	   	   	 $('".$replace."').html(data);
	   	   	 ".$js."
	   	   	 return false;
	   	   });
   	   ";
   	    
   	   return js_code($script);
   	  
   }
   static function ajaxForm($id,$script=null,$replace='##ajax-form-alert##:'){ 
   	    $update = "ajaxForm".md5(uniqid(microtime())); 
		js("
			$('#".$id."').ajaxForm(function(data) {  
				data = data.substr(strrpos(data,'".$replace."'));
				data = str_replace('".$replace."','',data);
				".$script." 
			}); 
		");	
		 
		js('misc/php.js');
		js('misc/jquery.form.js');
	 
   }
   static function sort($id,$url,$next='tbody'){ 
   	   	 core_js('jquery');
   	   	 core_js('jquery.ui');
   	   	 if($next){
   	   	 	$nextStr = "ui.helper.find('td').css({'width':ui.helper.find('td').attr('width')});  ";
   	   	 }
 	 	 js_code( " 
				var   node_form_sort;
				var fixHelper = function(e, ui) {
			        ui.children().each(function() {
			            $(this).width($(this).width());                  
			        });
			        return ui;
			    };
		 	 	$( '".$id." ".$next."' ).sortable({ 
				helper: fixHelper,
				start:function(e, ui){  
					node_form_sort=$('".$id."').serialize();
		            ui.helper.addClass('highlight');  
		            ".$nextStr." 
		            return ui;  
		        },  
		        stop:function(e, ui){   
		           ui.item.removeClass('highlight');  
		           if($('".$id."').serialize() == node_form_sort ) return false; 
		           $.post('".$url."',  $('".$id."').serialize(),function(data) {
					 	$('.flash-message').html('".__('success')."').show().fadeOut(3000);
				   });
		           return ui;  
		        }  	
			}).sortable('serialize'); ");
 	 }
}
<?php  
/**
* 
* @copyright 2013 The MinCMS Group
* @license http://mincms.com/licenses 
* @author Sun 
* @email  68103403@qq.com 
*/ 
class Widgets_Plupload_Init extends CWidget
{  
 	public $tag;
 	public $options; 
 	public $url;
 	public $field='file';//字段名
 	public $values;//image values
 	public $ext = '*';
 	public $max_file_size = '100mb';
 	public $info = 'upload';
 	public $multi = true;
 	public $max = 1000;
	function run(){  
		if($this->multi === false) $this->max = 1;
		$base = publish(dirname(__FILE__).'/assets'); 
		core_js('jquery');
		core_js('jquery.ui');
 		js($base.'/browserplus-min.js'); 
 		js($base.'/plupload.full.js'); 
 		$this->url = url('admin/plupload/index');
 		$container = 'c_'.md5(uniqid()).mt_rand(0,900000);
 		$filelist = 'f_'.md5(uniqid()).mt_rand(0,900000);
 		$pickfiles = 'p_'.md5(uniqid()).mt_rand(0,900000);
 		js_code("
 			var uploader_".md5($this->field)." = new plupload.Uploader({
		runtimes : 'gears,html5,flash,silverlight,browserplus',
		browse_button : '".$pickfiles."',
		container : '".$container."',
		multipart_params:{field:'".$this->field."'},
		max_file_size : '".$this->max_file_size."',
		multi_selection:'".$this->multi."',
		url : '".$this->url."',
		flash_swf_url : '".$base."/plupload.flash.swf',
		silverlight_xap_url : '".$base."plupload.silverlight.xap',
		filters : [
			{title : \"".__('choice file')."\", extensions : \"".$this->ext."\"} 
		],
	 
	});

 

	$('#uploadfiles').click(function(e) {
		uploader_".md5($this->field).".start();
		e.preventDefault();
	});

	uploader_".md5($this->field).".init();

	uploader_".md5($this->field).".bind('FilesAdded', function(up, files) {
		if (up.files.length > ".$this->max.") {
			alert('".__('not allow upload')."');
            return false;
        }
		$.each(files, function(i, file) {
			$('#".$filelist."').append(
				'<div id=\"' + file.id + '\">' +
				file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
			'</div>');
			uploader_".md5($this->field).".start();  
		});
		
		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader_".md5($this->field).".bind('UploadProgress', function(up, file) {
		$('#' + file.id + \" b\").html(file.percent + \"%\");
	});

	uploader_".md5($this->field).".bind('Error', function(up, err) {
		$('#".$filelist."').append(\"<div>Error: \" + err.code +
			\", Message: \" + err.message +
			(err.file ? \", File: \" + err.file.name : \"\") +
			\"</div>\"
		);

		up.refresh(); // Reposition Flash/Silverlight
	});
	uploader_".md5($this->field).".bind('FileUploaded', function(up, file,data) {  
		data = eval(data);
		data = data.response;  
	 	$('#".$filelist."').append(data); 
		$('#' + file.id + \" \").html(\"\");
		plupload_after_".md5($this->field)."();
	});
	plupload_after_".md5($this->field)."();
	function plupload_after_".md5($this->field)."(){
		$('#".$container." .file .icon-remove').click(function(){
			$(this).parent('div.file:first').remove();
		});
		
		$( '#".$filelist."' ).sortable();
    }
 		");
 		$this->render('index',array(
 			'container'=>$container,
 			'filelist'=>$filelist,
 			'field'=>$this->field,
 			'values'=>$this->values,
 			'pickfiles'=>$pickfiles,
 			'info'=>$this->info
 		));
 	 
	}
}
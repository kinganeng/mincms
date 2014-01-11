<?php  
// +----------------------------------------------------------------------
// | php mailer helper
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

/**
$mail = new MailerHelper;  
$mail->Subject = "test test";
$mail->Body = "this is body";
$mail->send('debug@qq.com','YiiPHP User');
*/

class MailerHelper
{ 
	public $mail;
 	public $Subject;
	public $FromName;
	public $Body;
	public $From;
	public $config;
	function __construct(){
		include base_path()."/vendor/phpmailer/PHPMailerAutoload.php";
		$this->config = config('PHPMailer'); 
		$this->mail = new PHPMailer; 
		$this->mail->isSMTP();                                      
		$this->mail->Host = $this->config['Host'];   
		$this->mail->SMTPAuth = true; 
		$this->mail->Username = $this->config['Username'];  
		$this->mail->Password = $this->config['Password'];    
		$this->mail->SMTPSecure = 'tls';  
	}
   
   
   function send($to,$name){
   	    if($this->config['From']) $this->From = $this->config['From'];
   	    if(!$this->From && !$this->config['From']) {
   	    	$this->From = $this->config['Username'].'@'.substr($this->config['Host'],5);
   	    }  
   	    if(!$this->FromName){
   	    	$this->FromName = $this->config['FromName'];    
   	    }
	   	$this->mail->From = $this->From;
		$this->mail->FromName = $this->FromName;
		$this->mail->addAddress($to,$name);  
		/*$this->mail->addReplyTo('info@example.com', 'Information');
		$this->mail->addCC('cc@example.com');
		$this->mail->addBCC('bcc@example.com');
		*/
		$this->mail->WordWrap = 50;                               
		//$this->mail->addAttachment('/var/tmp/file.tar.gz');   
		//$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg'); 
		$this->mail->isHTML(true);  
		$this->mail->Subject = $this->Subject;
		$this->mail->Body    = $this->Body;
		if($this->AltBody)
			$this->mail->AltBody = $this->AltBody; 
	   	return $this->mail->send(); 
   }
    
}
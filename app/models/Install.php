<?php

class Install extends CFormModel
{
	public $host;
	public $host_db;
	public $host_user;
	public $host_pwd;
	public $username;
	public $email;
	public $password;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
 			array('username, email, password, host,host_db,host_user,host_pwd', 'required'), 
 			array('email', 'email'), 
		);
	}

 
}
<?php
// +----------------------------------------------------------------------
// | MODEL 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

class UserIdentity extends CUserIdentity
{
    private $_id;
    public function authenticate()
    {
        $user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
        if($user===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
                $this->_id=$user->id;
                $this->setState('username', $user->username); 
                $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }

 
    public function getId()
    {
        return $this->_id;
    }
}
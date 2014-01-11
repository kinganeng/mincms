<?php
// +----------------------------------------------------------------------
// | ActiveForm
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------
class ActiveForm extends CActiveForm
{
  	public $rules; 
  	public $errorMessageCssClass = "alert alert-dismissable alert-danger";
  	public function errorSummary($models,$header=null,$footer=null,$htmlOptions=array())
	{
		$htmlOptions['class'] = $this->errorMessageCssClass;
		return parent::errorSummary($models,$header,$footer,$htmlOptions);
	}

	 
}

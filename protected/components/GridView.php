<?php
// +----------------------------------------------------------------------
// | GridView
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://mincms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed (http://mincms.com/licenses)
// +----------------------------------------------------------------------
// | Author: Kang Sun <fleaphp@msn.com>
// +----------------------------------------------------------------------

Yii::import('zii.widgets.grid.CGridView');

class GridView extends CGridView
{
  	 public $itemsCssClass  = 'table table-bordered table-hover tablesorter';
	 public $filterPosition  = false;
	 public $cssFile = false;
}

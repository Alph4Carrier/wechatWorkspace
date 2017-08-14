<?php

namespace app\index\controller;

use think\Controller;

class Detail extends Controller
{
	public function index()
	{
		$productionList = array();
		$cateArr = model('common/Category','model')->getCate();
		$this->assign("productionList", $productionList);
		$this->assign("cateList", $cateArr);
		return json(['code' => 0, 'html' => $this->fetch()]);
	}
}
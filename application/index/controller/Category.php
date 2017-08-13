<?php

namespace app\index\controller;

use think\Controller;

class Category extends Controller
{
	public function index()
	{
		$cateArr = array();
		//$cateArr = model('common/Category','model')->getCate();
		while (count($cateArr) < 6){
			array_push($cateArr, ['ID'=>'']);
		}
		$this->assign('cateList',$cateArr);
		return ['code' => 0, 'html' => $this->fetch()];
	}
}
<?php

namespace app\index\controller;

use think\Controller;

class Category extends Controller
{
	public function index()
	{
		$cateArr = array();
		$cateArr = model('common/Category','model')->getCate();
		$this->assign('cateList',$cateArr);
		return json(['code' => 0, 'html' => $this->fetch()]);
	}

	public function addCate()
	{
		$request = request();
		$name = $request->post("name");
		$picUrl = $request->post("pic");
		if ($name && $picUrl){
			$rst = model('common/Category','model')->addCate(['name'=>$name,"pic"=>$picUrl]);
			if($rst){
				$cateArr = model('common/Category','model')->getCate();
				return json(['code' => 0, 'msg' => "add success!", 'data' => $cateArr]);
			}
		}else{
			return json(['code' => -1, 'msg' => "param error."]);
		}
	}

	public function removeCate()
	{
		$request = request();
		if ($request->isPost()){
			$id = $request->post("id");
			if ($id){
				$rst = model('common/Category','model')->removeCate($id);
				return $rst;
			}else{
				return json(['code' => -2, 'msg' => 'param error.']);
			}
		}
	}

	public function editCate()
	{
		$request = request();
		if ($request->isPost()){
			$id = $request->post("id");
			$name = $request->post("name");
			$pic = $request->post("pic");
			if ($id && $name && $pic){
				$rst = model('common/Category','model')->editCate(['id'=>$id,"set"=>['name'=>$name,'pic'=>$pic]]);
				return $rst;
			}else{
				return json(['code' => -2, 'msg' => 'param error.']);
			}
		}
	}
}
<?php

namespace app\index\controller;

use think\Controller;

class About extends Common
{
	public function index()
	{
		$moduleList = array();
		$moduleList = model('common/About','model')->getModule();
		$this->assign("moduleList",$moduleList);
		return json(['code' => 0, 'html' => $this->fetch()]);
	}

	public function addModule()
	{
		$request = request();
		if($request->isPost()){
			$content = $request->post("content");
			$pic = $request->post("pic");
			if ($pic && $content){
				$rst = model('common/About','model')->addModule(['source_text'=>$content,"source_pic"=>$pic]);
				if($rst){
					$actArr = model('common/About','model')->getModule();
					return json(['code' => 0, 'msg' => "add success!", 'data' => $actArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function editModule()
	{
		$request = request();
		if($request->isPost()){
			$content = $request->post("content");
			$pic = $request->post("pic");
			$id = $request->post("id");
			if ($pic && $content && $id){
				$rst = model('common/About','model')->editModule(['ID'=>$id],['source_text'=>$content,"source_pic"=>$pic]);
				if($rst){
					$actArr = model('common/About','model')->getModule();
					return json(['code' => 0, 'msg' => "edit success!", 'data' => $actArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function deleModule()
	{
		$request = request();
		if($request->isPost()){
			$id  = $request->post("id");
			if($id){
				$where = array();
				$where['ID'] = $id;
				$rst = model('common/About','model')->deleModule($where);
				if($rst){
					$proArr = model('common/About','model')->getModule();
					return json(['code' => 0, 'msg' => "delete success!", 'data' => $proArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}
}
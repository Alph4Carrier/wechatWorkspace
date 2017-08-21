<?php
namespace app\index\controller;

use think\Controller;

class Activity extends Common
{
	public function index()
	{
		$activityList = array();
		$activityList = model('common/Activity','model')->getActivity();
		$this->assign("activityList", $activityList);
		return ['code' => 0, 'html' => $this->fetch()];
	}

	public function addActivity()
	{
		$request = request();
		if($request->isPost()){
			$title = $request->post("title");
			$content = $request->post("content");
			$pic = $request->post("pic");
			if ($title && $content && $pic){
				$rst = model('common/Activity','model')->addActivity(['title'=>$title,"content"=>$content,"pic"=>$pic]);
				if($rst){
					$actArr = model('common/Activity','model')->getActivity();
					return json(['code' => 0, 'msg' => "add success!", 'data' => $actArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function editActivity()
	{
		$request = request();
		if($request->isPost()){
			$actId   = $request->post("actId");
			$title   = $request->post("title");
			$content = $request->post("content");
			$pic     = $request->post("pic");
			if ($actId && $title && $content && $pic){
				$rst = model('common/Activity','model')->editActivity(['ID'=>$actId],['title'=>$title,"content"=>$content,"pic"=>$pic]);
				if($rst){
					$actArr = model('common/Activity','model')->getActivity();
					return json(['code' => 0, 'msg' => "add success!", 'data' => $actArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function deleActivity()
	{
		$request = request();
		if($request->isPost()){
			$deleId  = $request->post("deleId");
			$deleArr = json_decode($deleId, true);
			if(count($deleArr)){
				$where = array();
				$where['ID'] = ['in',$deleArr];
				$rst = model('common/Activity','model')->deleActivity($where);
				if($rst){
					$proArr = model('common/Activity','model')->getActivity();
					return json(['code' => 0, 'msg' => "delete success!", 'data' => $proArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}
}
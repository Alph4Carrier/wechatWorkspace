<?php

namespace app\index\controller;

use think\Controller;

class Detail extends Common
{
	public function index()
	{
		$productionList = array();
		$cateArr = model('common/Category','model')->getCate();
		if(count($cateArr)){
			$defaultCateId = $cateArr[0]['ID'];
			$productionList = model('common/Detail','model')->getProductionByCateId($defaultCateId);
		}
		$this->assign("productionList", $productionList);
		$this->assign("cateList", $cateArr);
		return json(['code' => 0, 'html' => $this->fetch()]);
	}

	public function addProduction()
	{
		$request = request();
		if($request->isPost()){
			$cateId = $request->post("cateId");
			$title = $request->post("title");
			$content = $request->post("content");
			$pic = $request->post("pic");
			if ($cateId && $title && $content && $pic){
				$rst = model('common/Detail','model')->addProduction(['title'=>$title,"content"=>$content,"pic"=>$pic,"category_id"=>$cateId]);
				if($rst){
					$proArr = model('common/Detail','model')->getProductionByCateId($cateId);
					return json(['code' => 0, 'msg' => "add success!", 'data' => $proArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function getProduction()
	{
		$request = request();
		if($request->isPost()){
			$cateId = $request->post("cateId");
			$proArr = model('common/Detail','model')->getProductionByCateId($cateId);
			return json(['code' => 0, 'msg' => "get success!", 'data' => $proArr]);
		}else{
			return json(['code' => -1, 'msg' => "type error."]);
		}
	}

	public function editProduction()
	{
		$request = request();
		if($request->isPost()){
			$proId   = $request->post("proId");
			$cateId  = $request->post("cateId");
			$title   = $request->post("title");
			$content = $request->post("content");
			$pic     = $request->post("pic");
			if ($proId && $cateId && $title && $content && $pic){
				$rst = model('common/Detail','model')->editProduction(['ID'=>$proId],['title'=>$title,"content"=>$content,"pic"=>$pic,"category_id"=>$cateId]);
				if($rst){
					$proArr = model('common/Detail','model')->getProductionByCateId($cateId);
					return json(['code' => 0, 'msg' => "add success!", 'data' => $proArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}

	public function deleProduction()
	{
		$request = request();
		if($request->isPost()){
			$cateId  = $request->post("cateId");
			$deleId  = $request->post("deleId");
			$deleArr = json_decode($deleId, true);
			if($cateId && count($deleArr)){
				$where = array();
				$where['category_id'] = $cateId;
				$where['ID'] = ['in',$deleArr];
				$rst = model('common/Detail','model')->deleProduction($where);
				if($rst){
					$proArr = model('common/Detail','model')->getProductionByCateId($cateId);
					return json(['code' => 0, 'msg' => "delete success!", 'data' => $proArr]);
				}
			}else{
				return json(['code' => -1, 'msg' => "param error."]);
			}
		}
	}
}
<?php

namespace app\api\controller;

use think\Controller;

class Getdetails extends Controller
{
	public function index()
	{
		$request = request();
		if($request->isPost()){
			$rst = array();
			$detailId = $request->post("id");
			$type = $request->post("type");
			if($detailId && $type){
				$detailArr = array();
				if($type == "product"){
					$detailArr = model('common/Detail','model')->getProductionByProId($detailId);
				}else if($type == "active"){
					$detailArr = model('common/Activity','model')->getActivityById($detailId);
				}
				foreach ($detailArr as $detailkey => $detailvalue) {
					$picArr = json_decode($detailvalue['pic'],true);
					$rst['id'] = $detailvalue['ID'];
					$rst['title'] = $detailvalue['title'];
					$rst['content'] = $detailvalue['content'];
					$rst['path'] = $picArr;
				}
				return json(['code' => 0, 're' => $rst]);
			}else{
				return json(['code' => -1, "msg" => 'param error!']);
			}
		}else{
			return json(['code' => -1, "msg" => 'type error!']);
		}
	}
}
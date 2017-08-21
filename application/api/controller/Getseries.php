<?php

namespace app\api\controller;

use think\Controller;

class Getseries extends Controller
{
	public function index()
	{
		$request = request();
		if($request->isPost()){
			$rst = array('list'=>array());
			$cateId = $request->post("series_id");
			$type = $request->post("type");
			if($type){
				if($type == "product"){
					if($cateId){
						$proArr = model('common/Detail','model')->getProductionByCateId($cateId);
					}
				}else if($type == "active"){
					$proArr = model('common/Activity','model')->getActivity();
				}
				foreach ($proArr as $prokey => $provalue) {
					$picArr = json_decode($provalue['pic'],true);
					array_push($rst['list'], array("id"=>$provalue['ID'],"title"=>$provalue['title'],"content"=>$provalue['content'],"path"=>$picArr[0]));
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
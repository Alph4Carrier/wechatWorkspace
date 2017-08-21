<?php

namespace app\api\controller;

use think\Controller;

class Getindex extends Controller
{
	public function index()
	{
		$request = request();
		if($request->isPost()){
			$rst = array('roll'=>array(),'list'=>array(),'tel'=>array());
			//轮播
			$rollArr = model('common/Round','model')->getPic();
			foreach ($rollArr as $rollkey => $rollvalue) {
				array_push($rst['roll'], "/".$rollvalue['source_url']);
			}
			//产品分类
			$cateArr = model('common/Category','model')->getCate();
			foreach ($cateArr as $catekey => $catevalue) {
				array_push($rst['list'], array("id"=>$catevalue['ID'],"title"=>$catevalue['name'],"path"=>$catevalue['pic']));
			}
			//电话
			$phoneOpen = model('common/Config','model')->getConfigByName('phone_chat_open');
			$phoneNumber = model('common/Config','model')->getConfigByName('phone_chat_number');
			array_push($rst['tel'], array("open"=>(string)$phoneOpen,"tel"=>$phoneNumber));
			return json(['code' => 0, 're' => $rst]);
		}else{
			return json(['code' => -1, "msg" => 'type error!']);
		}
	}
}
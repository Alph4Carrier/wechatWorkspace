<?php

namespace app\api\controller;

use think\Controller;

class Getus extends Controller
{
	public function index()
	{
		$request = request();
		if($request->isPost()){
			$rst = array('list'=>array());
			$moduleList = array();
			$moduleList = model('common/About','model')->getModule();
			foreach ($moduleList as $modulekey => $modulevalue) {
				array_push($rst['list'], array("content"=>$modulevalue['source_text'],"path"=>$modulevalue['source_pic']));
			}
			return json(['code' => 0, 're' => $rst]);
		}else{
			return json(['code' => -1, "msg" => 'type error!']);
		}
	}
}
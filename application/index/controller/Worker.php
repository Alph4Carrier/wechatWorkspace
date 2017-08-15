<?php

namespace app\index\controller;

use think\Controller;

class Worker extends Controller
{
	public function index()
	{
		$config = array();
		$config['greate_chat_open'] = model('common/Config','model')->getConfigByName('greate_chat_open');
		if($config['greate_chat_open'] != 0 && $config['greate_chat_open'] != 1){
			$rst = model('common/Config','model')->addConfig('greate_chat_open',0);
			$config['greate_chat_open'] = 0;
		}
		$config['phone_chat_open'] = model('common/Config','model')->getConfigByName('phone_chat_open');
		if($config['phone_chat_open'] != 0 && $config['phone_chat_open'] != 1){
			$rst = model('common/Config','model')->addConfig('phone_chat_open',0);
			$config['phone_chat_open'] = 0;
		}
		$config['phone_chat_number'] = model('common/Config','model')->getConfigByName('phone_chat_number');
		if(!$config['phone_chat_number']){
			$config['phone_chat_number'] = "";
		}
		$this->assign("config", $config);
		return json(['code' => 0, 'html' => $this->fetch()]);
	}

	public function editConfig()
	{
		$request = request();
		if($request->isPost()){
			$greateChat = $request->post("greateChat");
			$phoneChat = $request->post("phoneChat");
			$phoneNum = $request->post("phoneNum");
			if ($greateChat === "1" || $greateChat === "0"){
				$rst = model('common/Config','model')->editConfigByName('greate_chat_open',$greateChat);
			}
			if ($phoneChat === "1" || $phoneChat === "0"){
				$rst = model('common/Config','model')->editConfigByName('phone_chat_open',$phoneChat);
				$rst = model('common/Config','model')->editConfigByName('phone_chat_number',$phoneNum);
			}
			return json(['code' => 0]);
		}else{
			return json(['code' => -1, 'msg' => "param error."]);
		}
	}
}
<?php

namespace app\api\controller;

use think\Controller;

class Submitorder extends Controller
{
	public function index()
	{
		$request = request();
		if($request->isPost())
		{
			$name = $request->post("name");
			$type = $request->post("type");
			$tel = $request->post("tel");
			$id = $request->post("id");
			$time = $request->post("time");
			$sign = $request->post("sign");
			if($name && ($type == 0 || $type == 1) && $tel && $id && $time && $sign){
				$key = config('submit_order_sign_key');
				if($key){
					$nowtime = date("U");
					if($nowtime - $time <= "120"){
						if($sign == md5($key.$time)){
							$order = model('common/Order','model')->getOrderByWhere(['proId'=>$id,"phone"=>$tel,"type"=>$type]);
							if(count($order)){
								return json(['code'=>2,"msg"=>"submit exist!"]);
							}else{
								$data = array("name"=>$name,"type"=>$type,"phone"=>$tel,"day"=>date("Y-m-d"),"proId"=>$id);
								if($type == 0){
									$pro = model('common/Detail','model')->getProductionByProId($id);
								}else if($type == 1){
									$pro = model('common/Activity','model')->getActivityById($id);
								}
								if(count($pro)){
									$data['proName'] = $pro[0]['title'];
									$orderList = model('common/Order','model')->addOrder($data);
									if($orderList){
										return json(['code'=>0,"msg"=>"submit complete!"]);
									}else{
										return json(['code'=>-5,"msg"=>"submit error!"]);
									}
								}else{
									return json(['code'=>-6,"msg"=>"production doesn't exist!"]);
								}
							}
						}else{
							return json(['code'=>-4,"msg"=>"wrong time!"]);
						}
					}else{
						return json(['code'=>-3,"msg"=>"request overtime!"]);
					}
				}else{
					return json(['code'=>-2,"msg"=>"config error!"]);
				}
			}else{
				return json(['code'=>-1,"msg"=>"param error!"]);
			}
		}else{
			$time = date("U");
			return json(['code'=>0,"timestamp"=>$time]);
		}
	}
}
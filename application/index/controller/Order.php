<?php

namespace app\index\controller;

use think\Controller;

class Order extends Common
{
	public function index()
	{
		$startDay = date("Y-m-d",strtotime("-2 Days"));
		$endDay = date("Y-m-d");
		$orderList = model('common/Order','model')->getOrder($startDay,$endDay,0);
		$page = $orderList->render();
		$this->assign("startDay",$startDay);
		$this->assign("endDay",$endDay);
		$this->assign("page",$page);
		$this->assign("orderList",$orderList);
		return json(["code"=>0,"html"=>$this->fetch()]);
	}

	public function getOrder()
	{
		$request = request();
		$startDay = $request->get("startDay");
		$endDay = $request->get("endDay");
		if ($startDay && $endDay){
			$orderList = model('common/Order','model')->getOrder($startDay,$endDay,0);
			$page = $orderList->render();
			return json(['code' => 0, 'msg' => "add success!", 'data' => ['list'=>$orderList,"page"=>$page]]);
		}else{
			return json(['code' => -1, 'msg' => "param error."]);
		}
	}

	public function excelExport()
	{
		$request = request();
		$ids = $request->get("ids");
		$startDay = $request->get("startDay");
		$endDay = $request->get("endDay");
		$ids = json_decode($ids,true);
		if(count($ids)){
			$orderList = model('common/Order','model')->getOrderByIds($ids,0);
			$name='产品预约数据表（部分选中数据）_'.$startDay."_至_".$endDay;
		}else{
			$orderList = model('common/Order','model')->getOrderAll($startDay,$endDay,0);
			$name='产品预约数据表_'.$startDay."_至_".$endDay;
		}
		$header = ['姓名',"产品名称","电话","时间"];
		$data = array();
		foreach ($orderList as $orderkey => $ordervalue) {
			array_push($data, [$ordervalue['name'],$ordervalue['proName'],$ordervalue['phone'],$ordervalue['day']]);
		}
	   	$this->getExcelExport($name,$header,$data);
	}
}
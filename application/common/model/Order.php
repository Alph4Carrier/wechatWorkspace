<?php
namespace app\common\model;

use think\Model;
use think\db;

class Order extends Model
{
	public function getOrder($startDay,$endDay,$type)
	{
		$rst = db::name('order')->where('del',0)->where('type',$type)->where("day",">=",$startDay)->where("day","<=",$endDay)->paginate(10,false,[
		    'path'     => "getOrder",
		    "function" => "afterChangeDate",
		]);
		return $rst;
	}

	public function getOrderAll($startDay,$endDay,$type)
	{
		$rst = db::name('order')->where('del',0)->where('type',$type)->where("day",">=",$startDay)->where("day","<=",$endDay)->select();
		return $rst;
	}

	public function getOrderByIds($ids,$type)
	{
		$rst = db::name('order')->where('del',0)->where('type',$type)->where("ID","in",$ids)->select();
		return $rst;
	}

	public function getOrderByWhere($where)
	{
		$rst = db::name('order')->where('del',0)->where($where)->select();
		return $rst;
	}

	public function addOrder($data){
		$rst = db::name('order')->insertGetId($data);
		return $rst;
	}
}
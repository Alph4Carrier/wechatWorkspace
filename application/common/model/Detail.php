<?php
namespace app\common\model;

use think\Model;
use think\db;

class Detail extends Model
{
	public function addProduction($data)
	{
		$rst = db::name('production')->insertGetId($data);
		return $rst;
	}

	public function getProductionByCateId($cateId)
	{
		$rst = db::name('production')->where('del',0)->where("category_id",$cateId)->select();
		return $rst;
	}

	public function editProduction($where,$data)
	{
		if (!empty($where['ID'])){
			$rst = db::name('production')->where($where)->update($data);
			return $rst;
		}
	}

	public function deleProduction($where)
	{
		$rst = db::name('production')->where($where)->update(['del'=>"1"]);
		return $rst;
	}
}
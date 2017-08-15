<?php
namespace app\common\model;

use think\Model;
use think\db;

class Activity extends Model
{
	public function addActivity($data)
	{
		$rst = db::name('activity')->insertGetId($data);
		return $rst;
	}

	public function getActivity()
	{
		$rst = db::name('activity')->where('del',0)->select();
		return $rst;
	}

	public function editActivity($where,$data)
	{
		if (!empty($where['ID'])){
			$rst = db::name('activity')->where($where)->update($data);
			return $rst;
		}
	}

	public function deleActivity($where)
	{
		$rst = db::name('activity')->where($where)->update(['del'=>"1"]);
		return $rst;
	}
}
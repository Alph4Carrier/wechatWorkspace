<?php
namespace app\common\model;

use think\Model;
use think\db;

class About extends Model
{
	public function getModule()
	{
		$rst = db::name('us')->where('del',0)->select();
		return $rst;
	}

	public function addModule($data)
	{
		$rst = db::name('us')->insertGetId($data);
		return $rst;
	}

	public function editModule($where,$data)
	{
		if (!empty($where['ID'])){
			$rst = db::name('us')->where($where)->update($data);
			return $rst;
		}
	}

	public function deleModule($where)
	{
		$rst = db::name('us')->where($where)->update(['del'=>"1"]);
		return $rst;
	}
}
<?php
namespace app\common\model;

use think\Model;
use think\db;

class Category extends Model
{
	public function getCate()
	{
		$rst = db::name('category')->where('del',0)->select();
		return $rst;
	}

	public function addCate($data)
	{
		$rst = db::name('category')->insertGetId($data);
		return $rst;
	}

	public function removeCate($id)
	{
		if (!empty($id)){
			$rst = db::name('category')->where('ID',$id)->update(['del'=>"1"]);
			if($rst){
				$rstList = db::name('category')->where('del',0)->select();
				return json(['code'=>"0","data" => $rstList]);
			}else{
				return json(['code'=>"-1","msg"=>"delete error."]);
			}
		}else{
			return json(['code'=>"-1","msg"=>"param error."]);
		}
	}

	public function editCate($param)
	{
		if (!empty($param['id'])){
			$rst = db::name('category')->where('ID',$param['id'])->update($param['set']);
			if($rst){
				$rstList = db::name('category')->where('del',0)->select();
				return json(['code'=>"0","data" => $rstList]);
			}else{
				return json(['code'=>"-1","msg"=>"delete error."]);
			}
		}else{
			return json(['code'=>"-1","msg"=>"param error."]);
		}
	}
}
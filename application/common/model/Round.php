<?php
namespace app\common\model;

use think\Model;
use think\db;

class Round extends Model
{
	public function getPic()
	{
		$rst = db::name('round')->where('del',0)->select();
		return $rst;
	}

	public function removePic($id)
	{
		if(!empty($id)){
			$rst = db::name('round')->where('ID',$id)->update(['del'=>"1"]);
			if($rst){
				$rstList = db::name('round')->where('del',0)->select();
				return json(['code'=>"0","data" => $rstList]);
			}else{
				return json(['code'=>"-1","msg"=>"delete error."]);
			}
		}else{
			return json(['code'=>"-1","msg"=>"param error."]);
		}
	}

	public function addPic($path)
	{
		if(!empty($path)){
			$data = ['source_url' => $path];
			$rst = db::name('round')->insertGetId($data);
			if($rst){
				$rstList = db::name('round')->where('del',0)->select();
				return json(['code'=>"0","data" => $rstList]);
			}else{
				return json(['code'=>"-1","msg"=>"delete error."]);
			}
		}else{
			return json(['code'=>"-1","msg"=>"param error."]);
		}
	}

}
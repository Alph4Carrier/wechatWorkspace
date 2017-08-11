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
				return ['code'=>"0","msg"=>"delete complete."];
			}else{
				return ['code'=>"-1","msg"=>"delete error."];
			}
		}else{
			return ['code'=>"-1","msg"=>"param error."];
		}
	}

}
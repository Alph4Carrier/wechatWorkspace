<?php
namespace app\common\model;

use think\Model;
use think\db;

class Config extends Model
{
	public function addConfig($key, $value)
	{
		$rst = db::name('config')->where('config_key',$key)->select();
		if(count($rst)){
			return -1;
		}else{
			$rstAdd = db::name('config')->insertGetId(['config_key'=>$key,"config_value"=>$value]);
			return $rstAdd;
		}
	}

	public function getConfigByName($name)
	{
		$rst = db::name('config')->where('config_key',$name)->value('config_value');
		return $rst;
	}

	public function editConfigByName($name,$value)
	{
		$rst = db::name('config')->where('config_key',$name)->select();
		if(count($rst)){
			$rst = db::name('config')->where('config_key',$name)->update(['config_value'=>$value]);
		}else{
			$rst = db::name('config')->insertGetId(['config_key'=>$name,"config_value"=>$value]);
		}
		return $rst;
	}
}
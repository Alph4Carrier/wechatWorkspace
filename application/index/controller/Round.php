<?php
namespace app\index\controller;

use think\Controller;

class Round extends Controller
{
	public function index()
	{
		$picArr = model('common/Round','model')->getPic();
		while (count($picArr) < 3){
			array_push($picArr, ['ID'=>'']);
		}
		$this->assign('picList',$picArr);
		return ['code' => 0, 'html' => $this->fetch()];
	}

	public function removePic()
	{
		$request = request();
    	if ($request->isPost()){
    		$id = $request->post("id");
    		if ($id){
    			$rst = model('common/Round','model')->removePic($id);
    			return $rst;
    		}else{
    			return ['code' => -2, 'msg' => 'param error.'];
    		}
    	}
	}
}
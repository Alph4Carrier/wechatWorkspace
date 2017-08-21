<?php

namespace app\index\controller;

use think\Controller;

class Upload extends Common
{
	public function index()
	{
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('image');

	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
	    	return json(['code' => 0, "filePath" => $info->getSaveName()]);
	    }else{
	       // 上传失败获取错误信息
	       return json(['code' => -1, "msg" => $file->getError()]);
	    }
	}
}
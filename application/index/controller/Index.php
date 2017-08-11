<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
	public function _initialize()
	{
		$css_version = config('static_version_config.CSS_VERSION');
    	$js_version = config('static_version_config.JS_VERSION');
    	$this->assign("css_version", $css_version);
    	$this->assign("js_version", $js_version);
	}

    public function index()
    {
        return $this->fetch();
    }
}

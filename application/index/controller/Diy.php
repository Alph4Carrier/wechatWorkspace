<?php

namespace app\index\controller;

use think\Controller;

class Diy extends Controller
{
	public function index()
	{
		return json(['code' => 0, 'html' => $this->fetch()]);
	}
}
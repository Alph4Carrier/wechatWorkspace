<?php

namespace app\index\controller;

use think\Controller;

class Manager extends Common
{
	public function index()
	{
		return json(['code' => 0, 'html' => $this->fetch()]);
	}
}
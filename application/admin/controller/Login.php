<?php
namespace app\admin\controller;

use think\verify;
use think\Controller;
use app\admin\controller\VerifyImage;
use app\admin\model\AdminModel;

header('Content-type:application/json');
header('Content-type:text/html; charset=utf-8');

class Login extends Controller {
    public function index() {
        return view();
	}
}
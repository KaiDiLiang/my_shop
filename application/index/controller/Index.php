<?php
namespace app\index\controller;

use think\Controller;
use app\admin\controller\VerifyImage;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('../../admin/view/Login/index');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}

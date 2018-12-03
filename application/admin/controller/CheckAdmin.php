<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;
use app\admin\controller\Database;
use app\admin\controller\DoLogin;

class CheckAdmin extends Controller {
    public function index() {
       
    }

    public function checkAdmin() {
        $data_base = new Database();
        $sql = "Db::table('shop_admin')->where(['username' => 'admin', 'password' => md5('admin')])->selectOrFail()";
        var_dump($sql);exit;
        $data_base->fetchOne($sql);
    }
}
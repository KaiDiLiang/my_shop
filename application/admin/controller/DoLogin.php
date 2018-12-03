<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\admin\controller\Database;
use app\admin\controller\CheckAdmin;

class DoLogin extends Controller {
    public function index() {
        session_start();
        $check_admin = new CheckAdmin();
        // $username = $_POST['u_name'];
        // $password = md5($_POST['u_pwd']);
        // $verify = $_POST['verify'];
        // $verify1 = $_SESSION['verify'];
        $username='admin';$password=md5('admin');
        $verify = $verify1 = 'zasx';
        // var_dump($username,$password,$verify,$verify1);
        if ($verify == $verify1) {
            $sql = "Db::table('shop_admin')->where(['username' => 'admin', 'password' => md5('admin')])->selectOrFail()";
            $res = $check_admin->checkAdmin($sql);
            print_r($res);
        } else {
            echo '<script>alert("验证码错误");</script>';exit;
            echo '<script>window.location = "login";</script>';
        }
    }
}
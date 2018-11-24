<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\verify;

class Test extends Controller {
  public function index() {
    $datas = ['username' => 'kai', 'password' => md5('kai'), 'email' => 'kai930322@outlook.com'];
    $sql = Db::table('shop_admin')->where('id', 1)->update(['password' => md5('admin')]);
    // foreach ($datas as $key => $value) {
    //   echo $key . ":" . $value . "</br>";
    // }
    // $sql = Db::table('shop_admin')->insert($datas);
    if ($sql !== '') {
      echo "添加成功";
    }
    var_dump($sql);
  }
  
}
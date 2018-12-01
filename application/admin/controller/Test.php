<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\verify;
use app\admin\controller\VerifyImage;

class Test extends Controller {
  public function index() {
    // $datas = ['username' => 'kai', 'password' => md5('kai'), 'email' => 'kai930322@outlook.com'];
    // $sql = Db::table('shop_admin')->where('id', 1)->update(['password' => md5('admin')]);
    // // foreach ($datas as $key => $value) {
    // //   echo $key . ":" . $value . "</br>";
    // // }
    // // $sql = Db::table('shop_admin')->insert($datas);
    // if ($sql !== '') {
    //   echo "添加成功";
    // }
    // var_dump($sql);
  }

  public function gd_test() {
    if (extension_loaded('gd')) {
      echo '可以使用gd'.'<br>';
      foreach(gd_info() as $cate => $value) {
          echo $cate.':'. $value;
      }
  } else {
      echo '你没有安装gd扩展';
  }
  }
  
}
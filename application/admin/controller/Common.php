<?php
namespace app\admin\controller;

class Common {
    public function index() {

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
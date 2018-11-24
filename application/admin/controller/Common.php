<?php
namespace app\admin\controller;

use think\captcha\Captcha;

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

    public function show_captcha() {
        $captcha = new \think\captcha\Captcha();
        $captcha->imageW = 121;
        $captcha->imageH = 32;
        $captcha->fontSize = 14;
        $captcha->length = 4;
        $captcha->fontttf = '5.ttf';
        $captcha->expire = 30;
        $captcha->useNoise = false;
        return $captcha->entry();
    }

    public function common_post() {
        $code = input('post.captcha');
        $captcha = new \think\captcha\Captcha();
        $result = $captcha->check($code);
        if ($result === false) {
            echo '验证码错误';
        }
    }
}
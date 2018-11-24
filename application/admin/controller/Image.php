<?php
namespace app\admin\controller;

use app\admin\controller\RandomString;
use think\verify;

class Image {
    public function index() {
    
    }

    
    public function buildStringImage() {
        $randomString = new RandomString;
        /**通过GD库制作验证码*/
        $width = 80;
        $height = 28;

        /**
         * imagecreatetruecolor($width,$height)设置画布大小
         * imagecolorallocate($image,$color)设置画布的背景及字体颜色
         */
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        
        // 用填充矩形填充画布
        imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
        $stringType = 1;
        $stringLength = 4;
        $chars = $randomString->buildRandomString($stringType, $stringLength);
        $sess_name = 'verify';
        $_SESSION[$sess_name] = $chars;
        // 定义字体文件
        $fontfiles = array('SIMKAI.TTF', 'VERDANA.TTF', 'VERDANAB.TTF');
        for($i = 0; $i < $stringLength; $i++) {
            $size = mt_rand(14, 18);
            $angle = mt_rand(-15, 15);
            $x = 5 + $i * $size;
            $y = mt_rand(20, 26);
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            $fontfile = "../fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
            // 从第0位开始取1个字符串
            $text = substr($chars, $i, 1);
            imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }
        
        // 告诉浏览器需要显示的资源类型
        header('Content-Type:image/png');
        header('charset=UTF-8');
        // 调用并在使用后销毁
        imagepng($image);
        imagedestroy($image);
    }
}
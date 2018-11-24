<?php
namespace app\admin\controller;

use app\admin\controller\RandomString;
use think\GD;

/**通过GD库制作验证码*/

//  创建画布
$width = 80;
$height = 28;
// 画布大小
$image = imagecreatetruecolor($width, $height);
// 画布字体
$white = imagecolorallocate($image, 255, 255, 255);
// 画布背景
$black = imagecolorrallocate($image, 0, 0, 0);
// 用填充矩形填充画布
imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
$type = 1;
$length = 4;
$chars = buildRandomString($type, $length);
$sess_name = 'verify';
$_SESSION[$sess_name] = $chars;
// 定义字体文件
$fontfiles = array('simkai.ttf', 'verdana.ttf', 'verdanab.ttf', 'verdanai.ttf', 'verdanaz.ttf',
'msyh.ttc', 'msyhbd.ttc', 'msyhl.ttc', 'simsun.ttc');
for($i = 0; $i < $length; $i++) {
    $size = mt_rand(14, 18);
    $angle = mt_rand(-15, 15);
    $x = 5 + $i * $size;
    $y = mt_rand(20, 26);
    $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
    $fontfile = "../../fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
    // 从第0位开始取1个字符串
    $text = substr($chars, $i, 1);
    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
}
// 告诉浏览器需要显示的资源类型
header('content-type:image/gif');
// 调用并在使用后销毁
imagegif($image);
imagedestroy($image);
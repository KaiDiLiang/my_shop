<?php
namespace app\admin\controller;

use app\admin\controller\RandomString;
use think\verify;
use think\Controller;

class VerifyImage  extends Controller {
    public function index() {
        ob_clean();
        $verifyImage = new VerifyImage();
        return $verifyImage->buildVerifyImage();
    }

    
    public function buildVerifyImage($stringType = 3,$stringLength = 4,$sess_name = 'verify',$pixel = 1) {
        session_start();
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
        
        /**
         * imagefilledrectangle(resource image, int x1, int y1, int x2, int y2, int color)
         * 用填充矩形填充画布,x1,y1为左上角坐标，x2,y2为右下角坐标
         */
        imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
        
        // 生成验证码并赋值给$_SESSION的verify属性
        $chars = $randomString->buildRandomString($stringType, $stringLength);
        
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
            /** 
             * substr(string,start,length)
             * imagettftext()用TrueType字体向图像写入文本，返回值为array形式
             */
            $text = substr($chars, $i, 1);
            imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }
        
        if ($pixel) {
            for($i = 0; $i < 50; $i++) {
                imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
            }
        }
        // 告诉浏览器需要显示的资源类型
        header("Content-Type:image/png");
        /**
         * 方法一:
         * 用exit解决图片显示乱码，但是后续需要加载的东西会被终止，不好
         * imagegif($image);
         * imagedestroy($image);exit;
         */
        
        /**方法二：使用助手函数response()完美解决问题 */
        ob_start(); // 打开输出控制缓冲
        imagegif($image); // 输出图像
        $content = ob_get_clean(); //获取到缓冲区内容并删除当前输出缓存
        imagedestroy($image); // 销毁图片
        // 返回图片
        return response($content, 200, ['Content-Length' => strlen($content)])->contentType('image/png');
    }
}
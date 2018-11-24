<?php
namespace app\admin\controller;

class RandomString {
    public function index() {
    
    }
    /**产生验证码的随机字符串 */
    public function buildRandomString($stringType = 1, $stringLength = 4) {
        if ($stringType == 1) {
            $chars = join('', range(0, 9));
        } else if ($stringType == 2) {
            $chars = join('', array_merge(range('a', 'z'), range('A', 'Z')));
        } else {
            $chars = join('', array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9)));
        }

        if ($stringLength > strlen($chars)) {
            exit('字符串长度不够');
        }

        // str_shuffle(string)随机打乱字符串
        $chars = str_shuffle($chars);
        
        // substr(string,start,length)返回字符串的一部分
        return substr($chars, 0, $stringLength);
    }
}
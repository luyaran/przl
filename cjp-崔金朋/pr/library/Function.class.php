<?php
function D($model)
{
    $model = $model."Model";
    $obj = new $model();
    return $obj;
}
function P($length,$size)
{
    $obj = new Page($length,$size);
    return $obj;
}

//简单解密函数（与encrypt函数对应）
function decrypt($str, $key) {
    $str = base64_decode($str);
    $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
        $str = substr($str, 0, strlen($str) - $pad);
    }
    return unserialize($str);
}
//简单加密函数（与decrypt函数对应）
function encrypt($data, $key) {
    $prep_code = serialize($data);
    $block = mcrypt_get_block_size('des', 'ecb');
    if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
        $prep_code .= str_repeat(chr($pad), $pad);
    }
    $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
    return base64_encode($encrypt);
}

//转义字符串输出
function H($str)
{
    $key = 'luyaran';
    $strs = decrypt($str,$key);
    return htmlspecialchars($strs);
}
function Z($str)
{
    return htmlspecialchars($str);
}

//转义字符串入库
function mover($class)
{
    $key = 'luyaran';
    foreach($class as $k=>$val){
        $class[$k] = encrypt($val,$key);
    }
    return $class;
}

//定义公共文件路径
function url($class)
{
    return "././pub/".$class;
}

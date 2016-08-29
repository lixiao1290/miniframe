<?php
use minicore\model\model;
use app\success;
use minicore\lib\Mini;
use minicore\lib\Container;
use minicore\lib\ClosuresQueue;
use minicore\config\ConfigBase;
require 'vendor/autoload.php';

$model = new Model();

$sucess = Container::getSoleStance('app\Success', function () {
    return new \app\Success();
});

    
/*
 * $names=['l'=>'lixiao','lj'=>'linjiexi'];
 * extract($names);
 * $page=new page();
 *
 * $str="37012319891224173X";
 * $str=substr_replace($str, '%%%%', 4,-4);
 * echo $str;
 * var_dump('<pre>',$_FILES);
 */
 

exit();
$config = new ConfigBase();
$asoc = [
    'a' => 'b',
    'c' => '8df'
];
array_push($asoc, 'd');
/*
 * $code = var_export($config, true);
 * echo $code;
 */
// $array=array($code);
// var_dump($array);
$functions = array(
    'response' => function ($str) {
        for ($i = 0; $i < 2; $i ++) {
            echo $str;
        }
    }
);
// extract($functions);
function say($s)
{
    for ($i = 0; $i < 2; $i ++) {
        echo $s;
    }
}
echo '开始', microtime(true), '<br/>';
$functions['response']('hello world');
echo '结束', microtime(true), '<br/>';
echo '以上是闭包<br/>' ;

echo '开始',microtime(true), '<br/>';
say('hello world');
echo '结束',microtime(true), '<br/>';
echo '以上是直接调用';

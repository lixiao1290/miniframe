<?php
use minicore\model\model;
use app\success;
use minicore\lib\Mini;
use minicore\lib\Ioc;
use minicore\lib\Container;
use app\view\Index;
use app\view\page;
require 'vendor/autoload.php';






 $model=new Model();


 $mini=Mini::getInstance();
 $mini->init();
$sucess=Container::soleRegister('app\Success',function (){
    return new \app\Success();
});

$names=['l'=>'lixiao','lj'=>'linjiexi'];
extract($names);
$page=new page();

$str="37012319891224173X";
$str=substr_replace($str, '%%%%', 4,-4);
echo $str;
var_dump('<pre>',$_FILES);
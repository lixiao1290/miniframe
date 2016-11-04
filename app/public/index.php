<?php
use minicore\lib\Mini;
 
use minicore\helper\Db;

require '../../vendor/autoload.php';

(new Mini())->run();

$data=['name'=>'lixiao','hobby'=>'music,wine'];
Db::$user='root';
Db::$pass='root';
$db=Db::Instance(array('user'=>'root','pwd'=>'root'))->db('mini')->field(array('name','age'))->table('user')->insert($data);
 
//$db::debug() ;
 
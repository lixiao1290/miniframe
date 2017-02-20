<?php
use minicore\lib\MiniApp;
 
require '../../vendor/autoload.php';
 
$config=require dirname(dirname(__FILE__)).'/config/Config.php';
(new MiniApp($config))->run();
 


//$db::debug() ;
 
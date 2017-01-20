<?php
use minicore\lib\Mini;
 
require '../../vendor/autoload.php';
 
$config=require dirname(dirname(__FILE__)).'/config/Config.php';
(new Mini($config))->run();
 


//$db::debug() ;
 
<?php
use minicore\lib\MiniApp;

require '../../vendor/autoload.php';

$config=require dirname(dirname(__FILE__)).'/config/Config.php';
$config['params']=require dirname(dirname(__FILE__)).'/config/params.php';
(new MiniApp($config))->run();

/*$application = \minicore\lib\Mini::createObj(MiniApp::class,array('config'=>$config));
$application->run();*/


//$db::debug() ;
 
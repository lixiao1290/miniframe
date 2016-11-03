<?php
return array(
    'dbHost' => 'localhost',
    
    'dbUsr' => 'root',
    
    'dbPwd' => 'root',
    
    'dbName' => 'mini',
    
    'dbPort' => '3306',
    
    'dbPrex' => 'min',
    
    'dbdsn',
    
    'appdir',
    
    'actionLevel' => 1,
    
    'controllerLevel' => 0,
    
    'controllerNamespace' => 'app\controllers',
    'appNamespace'=>'app',
    
    // 框架核心初始化模式，1不使用closurequeue，2使用。
    'executeMode' => 1,
    // 路由类型，1默认，2注册
    'routType' => 1,
    'ControllerSuffix' => 'Controller',
    'viewSuffix' => 'php',
    'routClass'=>'minicore\lib\Rout',
    'routAct'=>'run',
    'actSuffix'=>'',
    'actPrefix'=>'',
    'defaultController'=>'controllers\index',
    'defaultAct'=>'index',
    'urlMode'=>1,
)
;

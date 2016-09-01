<?php
namespace minicore\config;

use minicore\lib\Base;

class ConfigBase extends Base
{

    public function __construct()
    {}

    public static $dbHost = 'localhost';

    public static $dbUsr = 'root';

    public static $dbPwd = 'root';

    public static $dbName = 'mini';

    public static $dbPort = '3306';

    public static $dbPrex = 'min';

    public static $dbdsn;

    public static $appdir;

    public static $actionLevel = 1;

    public static $executeMode = 1;
 // 框架核心初始化模式，1不使用closurequeue，2使用。
     
}


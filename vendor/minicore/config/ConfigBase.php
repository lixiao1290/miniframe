<?php
namespace minicore\config;

class ConfigBase
{

    public function __construct()
    {}
    public static $DbHost='localhost';
    public static $DbUsr='root';
    public static $DbPwd='root';
    public static $DbName='mini';
    public static $DbPort='3306';
    public static $DbPrex='localhost';
    public static $DbDsn;
}


<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;

class Mini implements MiniBase
{

    private static $stance;
    public function getVersion()
    {
        return self::version;
    }
    public static function getInstance()
    {
        if(is_object(self::$stance)) {
            return self::$stance;
        } else {
            self::$stance=new self();
            return self::$stance;
        }
    }
    private  function __construct()
    {}
    function __clone()
    {
        echo  '不可克隆';
    }
    public function getConfig()
    {}

    public function setConfig()
    {}

}


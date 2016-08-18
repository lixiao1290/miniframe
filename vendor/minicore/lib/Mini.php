<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;
use minicore\config\ConfigBase;

class Mini implements MiniBase
{

    private $config;
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
    public function getConfig(ConfigBase $config)
    {
        $this->config=$config;
    }

    public function setConfig()
    {
        return $this->config;
    }
    public function run()
    {

    }
    public function init()
    {
        if(empty($this->config)) {
            $this->setConfig(ConfigBase);
        } else {

        }
    }
    public function getRout()
    {

    }
    public function setRout()
    {

    }
}


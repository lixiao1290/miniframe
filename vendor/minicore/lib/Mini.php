<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;
use minicore\config\ConfigBase;
use minicore\traits\SingleInstance;
use minicore\helper\Db;

class Mini implements MiniBase
{

    private $config;

    /**
     * {@inheritDoc}
     * @see \minicore\interfaces\MiniBase::getVersion()
     */
    public function getVersion()
    {
        return self::version;
    }
    use SingleInstance;/* 导入单例模式trait */

    function __clone()
    {
        echo  '不可克隆';
    }
    /**
     * {@inheritDoc}
     * @see \minicore\interfaces\MiniBase::getConfig()
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config=$config;
    }
    public function run()
    {

    }
    
    public function __construct(ConfigBase $config)
    {
        $this->config=$config;
        /* Db对象注入 */
        Container::register('Db', function()use($config) {
            $db=new  Db();
            $db->config=$config;
            
        });
    }
    public function getRout()
    {

    }
    public function setRout()
    {

    }
}


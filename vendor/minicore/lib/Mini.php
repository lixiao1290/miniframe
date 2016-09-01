<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;
use minicore\config\ConfigBase;
use minicore\traits\SingleInstance;
use minicore\helper\Db;

class Mini extends Base implements MiniBase    
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
        /* $arrayFile=dir($config->getFile()).$config::class.'.php';
        if(false===is_file($arrayFile)) {
            $configArray=get_object_vars($config);
            $configArrayCode=var_export($configArray,true);
            file_put_contents(dir($config->getFile()).$config::class.'.php', $data);
        } else {
            
        } */
        
        $this->config=$config;
        /* Db对象注入 */
        Container::register('Db', function()use($config) {
            $db=new  Db();
            $db->config=$config;
            return $db;
        });
        
    }
    public function getRout()
    {

    }
    public function setRout()
    {

    }
}


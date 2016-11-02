<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;
use minicore\config\ConfigBase;
use minicore\traits\SingleInstance;
use minicore\helper\Db;

class Mini extends Base implements MiniBase
{

    private $config;

    public static $Mini;

    private  $controller;

    private $act;

    private $baseDir;

    private $controllerStance;
    /**
     * @return the $controllerStance
     */
    public function getControllerStance()
    {
        return $this->controllerStance;
    }

    public $appPath;
    /**
     * @return the $appPath
     */
    public function getAppPath()
    {
        return $this->appPath;
    }
    
    /**
     * @param field_type $appPath
     */
    public function setAppPath($appPath)
    {
        $this->appPath = $appPath;
    }
    /**
     * @param field_type $controllerStance
     */
    public function setControllerStance($controllerStance)
    {
        $this->controllerStance = $controllerStance;
    }

    /**
     *
     * @return the $controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     *
     * @return the $act
     */
    public function getAct()
    {
        return $this->act;
    }

    /**
     *
     * @param field_type $controller            
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     *
     * @param field_type $act            
     */
    public function setAct($act)
    {
        $this->act = $act;
    }

    /**
     *
     * @return the $baseDir
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     *
     * @param field_type $baseDir            
     */
    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \minicore\interfaces\MiniBase::getVersion()
     */
    public function getVersion()
    {
        return self::version;
    }
    use SingleInstance;

    /* 导入单例模式trait */
    function __clone()
    {
        echo '不可克隆';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \minicore\interfaces\MiniBase::getConfig()
     */
    public function getConfig($key)
    {
        return $this->config[$key];
    }

    public function setConfig($key, $value)
    {
        $this->config[$key] = $value;
    }

    public function run()
    {
        if (1 == $this->config['executeMode']) {
            call_user_func(array(
                $this->getConfig('routClass'),
                $this->getConfig('routAct')
            ));
        }
    }

    public function __construct($config = null)
    {
        /*
         * $arrayFile=dir($config->getFile()).$config::class.'.php';
         * if(false===is_file($arrayFile)) {
         * $configArray=get_object_vars($config);
         * $configArrayCode=var_export($configArray,true);
         * file_put_contents(dir($config->getFile()).$config::class.'.php', $data);
         * } else {
         *
         * }
         */
        if (empty($config)) {
            // $cofigfiles=realpath('../config/Config.php');
            $this->config = include dirname(__FILE__) . '/../config/Config.php';
        } else {
            
            $this->config = $config;
        }
        self::$Mini = $this;
        $baseDir = dirname(dirname(dirname(dirname(__FILE__))));
        $this->setBaseDir($baseDir);
        
        $path = $this->getConfig('controllerNamespace');
        $this->setAppPath(dirname($path));
        
       /*  Container::register('Mini', function () use ($config) {
            $mini=new Mini();
            if (empty($config)) {
                // $cofigfiles=realpath('../config/Config.php');
                $mini->config = include dirname(__FILE__) . '/../config/Config.php';
            } else {
                
                $mini->config = $config;
            }
            ConfigBase::setConfig($mini->config);
            return $mini;
        }); */
    }

    public function getRout()
    {}

    public function setRout()
    {}
}


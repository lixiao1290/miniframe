<?php
namespace minicore\lib;

use minicore\interfaces\MiniBase;
use minicore\config\ConfigBase;
use minicore\traits\SingleInstance;
use minicore\helper\Db;

class Mini extends Base implements MiniBase
{

    private $config;

    private static  $controller;
    private static $act;
    

    /**
     * @return the $controller
     */
    public static function getController()
    {
        return Mini::$controller;
    }

    /**
     * @return the $act
     */
    public static function getAct()
    {
        return Mini::$act;
    }

    /**
     * @param field_type $controller
     */
    public static function setController($controller)
    {
        Mini::$controller = $controller;
    }

    /**
     * @param field_type $act
     */
    public static function setAct($act)
    {
        Mini::$act = $act;
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
            if (1 == $this->config['routType']) {
                $pathInfo = $_SERVER['PATH_INFO'];
                $rout = Rout::parseUrl($pathInfo);
                $Controller = $this->getConfig('controllerNamespace') . '\\' . $rout['controller'] . $this->getConfig('ControllerSuffix');
                self::setController($Controller);
                self::setAct($rout['act']);
               
                if (class_exists($Controller)) {
                    call_user_func(array(
                        self::getController(),
                        self::getAct()
                    ));
                } else {
                    echo ('未发现控制器，检查您的url');
                }
            }
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
        
        Container::register('Mini', function () use ($config) {
            $mini=new Mini();
            if (empty($config)) {
                // $cofigfiles=realpath('../config/Config.php');
                $mini->config = include dirname(__FILE__) . '/../config/Config.php';
            } else {
                
                $mini->config = $config;
            }
            ConfigBase::setConfig($mini->config);
            return $mini;
        });
    }

    public function getRout()
    {}

    public function setRout()
    {}
}


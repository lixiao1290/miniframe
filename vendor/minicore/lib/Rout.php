<?php
namespace minicore\lib;

use minicore\config\ConfigBase;
use app;

/**
 *
 * @author lixiao
 *        
 */
class Rout
{

    /* url参数分隔符 */
    public static $urlDelimiter = '/';

    /* 控制器 在url参数中位置是第几个 */
    public static $controllerLevel = 0;

    public static $actLevel = 3;

    public function __construct(ConfigBase $config)
    {}

    /* 路由键值对，键名是url，值是对应的控制器 调用闭包 */
    private static $_get = array();

    private static $_post = array();

    /**
     *
     * @param multitype: $rule            
     */
    public static function get($url, \Closure $act)
    {
        self::$rule[$url] = $act;
    }

    public static function post($url, \Closure $act)
    {}

    public static function getRule($key)
    {
        if (array_key_exists($key, $this->rule)) {
            return $this->rule[$key];
        }
    }

    public static function initGet($array)
    {
        while ($var = array_shift($array)) {
            $_GET[$var] = array_shift($array);
        }
    }

    /**
     * 生成控制方法arr。.
     * @param unknown $url
     * @throws \ErrorException
     * @return string[]|mixed[]|string[]|mixed[]|\minicore\lib\the[]
     */
    public static function generatController($url)
    {
        if (is_null(self::$controllerLevel)) {
            throw new \ErrorException('未设置控制器层级！');
        } else {
            if (2 == self::$actLevel) {
                $pars = explode('\\', $url);
                $pars = array_filter($pars);
                $actArr = array_splice($pars, 0, self::$actLevel);
                self::initGet($pars);
                $act = array_pop($actArr);
                $controller = 'controllers\\' . array_pop($actArr);
                
                return array(
                    'controller' => $controller,
                    'act' => $act
                );
            } else {
                $pars = explode('\\', $url);
                $pars = array_filter($pars);
                $actArr = array_splice($pars, 0, self::$actLevel);
                $act = array_pop($actArr);
                $controller = array_pop($actArr);
                if (empty($controllerId)) {
                    $controllerId = Mini::$Mini->getConfig('defaultController');
                }
                
                Mini::$Mini->setModule(implode('\\', $actArr));
                if (! Mini::$Mini->getModule()) {
                    Mini::$Mini->setModule(Mini::$Mini->getConfig('defaultModule'));
                } else {}
                $controller = $controller;
                $rout = array(
                    'controller' => $controller,
                    'act' => $act,
                    'module' => Mini::$Mini->getModule()
                );
                if(''==$rout['controller']) {
                    $rout['controller']=Mini::$Mini->getConfig('defaultController');
                }
                if ($rout['act'] == '') {
                    
                    $rout['act'] = Mini::$Mini->getConfig('defaultAct');
                }
                
                return $rout;
            }
        }
    }

    /**
     * 运行程序撒......
     */
    public static function run()
    {
        if (1 == Mini::$Mini->getConfig('routType')) {
            // if($config=Mini::$Mini->getConfig('layout')) {
            // foreach ($config as $row) {
            // self::partial($row);
            // }
            // }
            $path = self::analyzeUrl(); // echo $path;
            $rout = Rout::generatController($path); 
            if ($rout['module']) {
                $Controller = Mini::$Mini->getConfig('appNamespace') . '\\' . $rout['module'] . '\\controllers\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix');
            } else {
                $Controller = Mini::$Mini->getConfig('appNamespace') . '\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix');
            }
             
            Mini::$Mini->setController($Controller);
            Mini::$Mini->setAct(Mini::$Mini->getConfig('actPrefix') . $rout['act'] . Mini::$Mini->getConfig('actSuffix'));
            if (class_exists($Controller)) {
                $ControllerObj = new $Controller();
                Mini::$Mini->setControllerStance($ControllerObj);
                call_user_func(array(
                    $ControllerObj,
                    Mini::$Mini->getAct()
                ));
            } else {
                echo ('未发现控制器，检查您的url');
            }
        }
    }

    public static function analyzeUrl($url = null)
    {
        if (empty($url)) {
            
            if (1 == Mini::$Mini->getConfig('urlMode')) {
                if (isset($_SERVER['PATH_INFO'])) {
                    return strtr($_SERVER['PATH_INFO'], array(
                        '/' => '\\'
                    ));
                } else {
                    $uri = $_SERVER['REQUEST_URI']; // echo $uri,'<br>';
                    $root = $_SERVER['DOCUMENT_ROOT']; // echo $root,'<br>';
                    $scriptFileName = dirname($_SERVER['SCRIPT_FILENAME']); // echo 'scrii',$scriptFileName,'<br>';
                    $str = strtr($scriptFileName, array(
                        $root => null
                    )); // echo $str,'<br>';
                    $rs = strtr($uri, array(
                        $str => null
                    )); // exit;
                    return strtr($rs, array(
                        '/' => '\\',
                        'index.php' => ''
                    ));
                }
            }
        } else {
            return strtr($url, array(
                '/' => '\\'
            ));
        }
    }

    public static function partial($path)
    {
        $path = self::analyzeUrl($path);
        $rout = self::generatController($path);
        if ($rout['module']) {
            $Controller = Mini::$Mini->getConfig('appNamespace') . '\\' . $rout['module'] . '\\controllers\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix');
        } else {
            $Controller = Mini::$Mini->getConfig('appNamespace') . '\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix');
        }
        if (class_exists($Controller)) {
            $ControllerObj = call_user_func(array(
                $Controller,
                '__CONSTRUCT'
            ));
            call_user_func(array(
                $ControllerObj,
                $rout['act']
            ));
        } else {
            echo (' ');
        }
    }

    public static function callAct($rout)
    {
        
    }
}


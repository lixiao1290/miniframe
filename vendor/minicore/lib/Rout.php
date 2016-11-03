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

    public static $actLevel=3;
    public function __construct(ConfigBase $config)
    {
        self::$controllerLevel = $config::$controllerLevel;
    }

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
    public static function initGet ($array)
    {
         
        while ($var=array_shift($array)) {
            $_GET[$var]=array_shift($array);
        }
         
    }

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
                $act=array_pop($actArr); 
                $controller='controllers\\'.array_pop($actArr);
                
                
                return array(
                    'controller' => $controller,
                    'act' => $act
                );
            } else {
                $pars = explode('\\', $url);
                $pars = array_filter($pars); 
                $actArr = array_splice($pars, 0, self::$actLevel);
                $act=array_pop($actArr); 
                $controllerend='controllers\\'.array_pop($actArr);
                $controller=implode('\\', $actArr).'\\'.$controllerend;
                $rout=array(
                    'controller' => $controller,
                    'act' => $act
                );
                if ($rout['act']=='') {
                
                    $rout['act'] = Mini::$Mini->getConfig('defaultAct');
                }
                if($rout['controller']=='\\controllers\\') {
                    $rout['controller']=   Mini::$Mini->getConfig('defaultController');
                    if(Mini::$Mini->getConfig('defaultModule'))    {
                        $rout['controller']=Mini::$Mini->getConfig('defaultModule').'\\'.$rout['controller'];
                    }
                }
                
                return $rout;
                
            }
        }
    }

    public static function run()
    {
        if (1 == Mini::$Mini->getConfig('routType')) {
            $path =self::analyzeUrl() ; 
            $rout = Rout::generatController($path); 
            
            $Controller = Mini::$Mini->getConfig('appNamespace') . '\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix'); 
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
    public static function  analyzeUrl($url=null)
    {
        if(1==Mini::$Mini->getConfig('urlMode')) {
            if(isset($_SERVER['PATH_INFO'])) {
                return strtr($_SERVER['PATH_INFO'],array('/'=>'\\'));
            } else {
                $uri=$_SERVER['REQUEST_URI'];
                $root=$_SERVER['DOCUMENT_ROOT'];
                $scriptFileName=dirname($_SERVER['SCRIPT_FILENAME']);
                $str=strtr($scriptFileName,array($root=>null)); 
                $rs= strtr($uri,array($str=>null));
                return  strtr($rs,array('/'=>'\\'));
            }    
        }
        
    }

    public static function partial($var)
    {
        $rout=self::generatController($var);
        
    }
}


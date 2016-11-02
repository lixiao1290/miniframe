<?php
namespace minicore\lib;

use minicore\config\ConfigBase;

/**
 *
 * @author lixiao
 *        
 */
class Rout
{

    /* url参数分隔符 */
    public static $urlDelimiter = '/';

    /* act在url参数中位置是第几个 */
    public static $controllerLevel = 0;

    public function __construct(ConfigBase $config)
    {
        self::$controllerLevel=$config::$controllerLevel;
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
    public static function post($url,\Closure $act)
    {
        
    }
    public static function getRule($key)
    {
        if (array_key_exists($key, $this->rule)) {
            return $this->rule[$key];
        }
    }

    public static function parseUrl($url)
    {
        if (empty(self::$urlDelimiter)) {
            throw new \ErrorException('未设置url分隔符！');
        }
        if (is_null(self::$controllerLevel)) {
            throw new \ErrorException('未设置控制器层级！');
        } else {
            $pars = explode(self::$urlDelimiter, $url);
            $pars=array_filter($pars);
            $actArr = array_splice($pars, self::$controllerLevel,2 );
            if(empty($actArr)) {
                $actArr=array((Mini::$Mini->getConfig('defaultController')),(Mini::$Mini->getConfig('defaultAct')));
            }
            return array(
                'controller' => $actArr[0],
                'act' => $actArr[1]
            );
        }
    }
    public static function run(){
        if (1 == Mini::$Mini->getConfig('routType')) {
            @ $pathInfo = $_SERVER['PATH_INFO'];
                $rout = Rout::parseUrl($pathInfo);
                $Controller = Mini::$Mini->getConfig('controllerNamespace') . '\\' . $rout['controller'] . Mini::$Mini->getConfig('ControllerSuffix');
                Mini::$Mini->setController($Controller);
                Mini::$Mini->setAct(Mini::$Mini->getConfig('actPrefix').$rout['act'].Mini::$Mini->getConfig('actSuffix'));
        
                if (class_exists($Controller)) {
                    $ControllerObj = new   $Controller();
                    Mini::$Mini->setControllerStance($ControllerObj);
                    call_user_method(Mini::$Mini->getAct(),$ControllerObj );
                } else {
                    echo ('未发现控制器，检查您的url');
                }
             
        }
    }
}


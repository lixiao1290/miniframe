<?php
namespace minicore\lib;

/**
 * @author lixiao
 *
 */
class Rout
{

    /* url参数分隔符 */
    public static $urlDelimiter='/';
    /* 控制器在url参数中占前几个 */
    public static $controllerLevel=2;
    public function __construct()
    {}

    /* 路由键值对，键名是url，值是对应的控制器 调用闭包*/
    private static $rule = array();


    /**
     *
     * @param multitype: $rule            
     */
    public static function setRule($url, \Closure $act)
    {
        self::$rule[$url] = $act;
    }

    public static function getRule($key)
    {
        if (array_key_exists($key, $this->rule)) {
            return $this->rule[$key];
        }
    }

    public static function parseUrl($url)
    {
        if(empty(self::$urlDelimiter)) {
            throw new \ErrorException('未设置url分隔符！');
        }
        if(empty(self::$controllerLevel)) {
            throw new \ErrorException('未设置控制器层级！');
        } else {
            $pars=explode(self::$urlDelimiter, $url);
            $actArr=array_splice($pars, 0,self::$controllerLevel);
            return array('p'=>$pars,'a'=>$actArr);
        }
    }
}


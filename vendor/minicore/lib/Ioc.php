<?php
namespace minicore\lib;

class Ioc
{
    /**
     * @var 注册的依赖数组
     */
    protected static $registry = array();
    public function __construct()
    {

    }
    /**
     * 添加一个resolve到registry数组中
     * @param  string $name 依赖标识
     * @param  object $resolve 一个匿名函数用来创建实例
     * @return void
     */
    public static function register($name, \Closure $resolve)
    {
        static::$registry[$name] = $resolve;
    }

    /**
     * 返回一个实例
     * @param  string $name 依赖的标识
     * @return mixed
     */
    public static function getinstance($name)
    {
        if ( static::registered($name) )
        {
            $name = static::$registry[$name];
            return $name();
        }
        throw new \Exception('Nothing registered with that name, fool.');
    }
    /**
     * 查询某个依赖实例是否存在
     * @param  string $name id
     * @return bool
     */
    public static function registered($name)
    {
        return array_key_exists($name, static::$registry);
    }
}


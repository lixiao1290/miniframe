<?php
namespace minicore\traits;

/**
 * @author lixiao Administrator
 *单例模式trait
 */
trait SingleInstance {

    /* 唯一实例 */
    private static $stance;
    /*  获得唯一实例*/
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
    {

    }
}


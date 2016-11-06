<?php
namespace minicore\traits;

/**
 * @author lixiao Administrator
 *单例模式trait
 */
trait SingleInstance {

    /* 唯一实例 */
    private static $instance;
    /*  获得唯一实例*/
    public static function instance($members=NULL)
    {
        if(is_object(self::$instance)) {
            return self::$instance;
        } else {
            self::$instance=new static();
            foreach ($members as $key=>$value) {
                self::$instance->$key=$value;
            }
            return self::$instance;
        }
    }
    private  function __construct()
    {
        echo 'obj';
       
    }
}


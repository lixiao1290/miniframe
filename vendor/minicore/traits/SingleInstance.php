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
    public static function Instance($members=NULL)
    {
        if(is_object(self::$stance)) {
            return self::$stance;
        } else {
            self::$stance=new self($members);
            foreach ($members as $key=>$value) {
                self::$key=$value;
            }
            return self::$stance;
        }
    }
    private  function __construct($members )
    {
//         echo 'obj'
       
    }
}


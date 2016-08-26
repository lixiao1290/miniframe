<?php
namespace minicore\lib;

class Rout
{

    public function __construct()
    {}
    /*  路由键值对，键名是url，值是对应的控制器*/
    private static  $rule=array();
    /**
     * @return the $rule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param multitype: $rule
     */
    public static  function setRule($url,\Closure $act)
    {
        self::$rule[$url]=$act;
    }
    public static  function getRule($key)
    {
        if(array_key_exists($key, $this->rule)) {
            return $this->rule[$key];
        }
    }

}


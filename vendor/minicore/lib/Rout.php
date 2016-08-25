<?php
namespace minicore\lib;

class Rout
{

    public function __construct()
    {}
    /*  路由键值对，键名是url，值是对应的控制器*/
    private $rule=array();
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
    public function setRule($url)
    {
        $this->rule = $rule;
    }
    public function __set($key,$value)
    {
        $this->rule[$key]=$value;
    }
    public function __get($key)
    {
        if(array_key_exists($key, $this->rule)) {
            return $this->rule[$key];
        }
    }


}


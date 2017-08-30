<?php

namespace minicore\config;

use minicore\lib\Base;

class Configer extends Base
{

    private static $config = array();

    /**
     * Configer::getConfig('db.db')
     * @return the $config
     */
    public static function getConfig(  $patterm)
    {
        $return = self::$config;
        $tok = strtok($patterm, '.');
        while ($tok !== false) {
            $return = $return[$tok];
            $tok = strtok('.');
        }
        return $return;
    }




    /**
     *
     * @param multitype : $config
     */
    public static function setConfig($config)
    {
        Configer::$config = $config;
    }

    public function __construct()
    {
    }

}


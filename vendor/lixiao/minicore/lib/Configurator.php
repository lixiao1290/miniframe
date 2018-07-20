<?php

namespace minicore\lib;

use minicore\interfaces\Configable;

class Configurator extends Base implements Configable
{
    /**
     * @var array
     */
    private static $config = array();

    /**
     * Configer::getConfig('db.db')
     * @return the $config
     */
    public static function getConfigByName($name)
    {
        if (!empty($name)) {
            if (array_key_exists($patterm, self::$config))
                return self::$configs[$name];
        }
    }

    public static function getConfigs()
    {
        return self::$configs;
    }

    public static function getConfigByPatterm($patterm = null)
    {
        $return = self::$configs;
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
    public static function setConfig($config, $name)
    {
        self::$config[$name] = $configs;
    }

    /**
     * Configer constructor.
     */
    public function __construct()
    {
    }

}

  
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20 0020
 * Time: 下午 16:51
 */

namespace minicore\interfaces;


interface Configable
{
    public static function getConfigs();
    public static function getConfigByName($name);
    public static function getConfigByPatterm($patterm = null);
    public static function setConfig($config, $name);

}
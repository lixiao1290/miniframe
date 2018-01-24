<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24 0024
 * Time: 下午 16:23
 */

namespace minicore\lib;


class View
{
    public static function view($path = NULL)
    {
        // exit;
        if (is_null($path)) {
            // print_r(dirname());
            // echo '@',__FUNCTION__;

            $actdir = Mini::$app->getControllerName();
            $actfile = Mini::$app->getAct();
            $filename = Mini::$app->getControllerStance()->getViewPath(). '\\' . strtolower($actdir) . '\\' . strtolower($actfile) . '.' . Mini::$app->getConfig('viewSuffix');
            // var_dump('<pre>',debug_backtrace());
            if (file_exists($filename)) {
                extract(Mini::$app->getControllerStance()->getViewVars());

                include $filename;
                return 0;
            } else {
                echo "未找到视图文件";
            }
        }
    }
}
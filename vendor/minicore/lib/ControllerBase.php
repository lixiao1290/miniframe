<?php
namespace minicore\lib;

class ControllerBase extends Base
{

    public static function view($path = NULL)
    {
        if (is_null($path)) {
            // print_r(dirname());
            // echo '@',__FUNCTION__;
            $a = new Mini();
            var_dump($a);
        }
    }
}


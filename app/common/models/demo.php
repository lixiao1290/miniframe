<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24 0024
 * Time: 下午 17:16
 */

namespace common\models;


use app\main\controllers\base;

class demo
{
    public function __construct(User $user)
    {
        if ($user == null) {
            echo djfai;
        }
    }

    public function big()
    {
        var_dump("<pre>",range("A","Z"));
    }
}
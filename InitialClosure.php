<?php

class InitialClosure
{

    public $name;

    public static $init;
    public function __construct()
    {
        if(self::$init instanceof Closure) {
            call_user_func(self::$init,$this);
        }
    }
}

$array = array(
    'data' => function ($a) {
        $a->name = 'ddee';
        return $a;
    }
);

InitialClosure::$init=$array['data'];
$init=new InitialClosure();
echo $init->name;
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
//echo $init->name;
class a{
    public $a;
    public static $b;
}

//echo property_exists(a, 'b');

$ref=new ReflectionClass(a::class);
$statics=$ref->getStaticProperties();
echo array_key_exists('a', $statics);
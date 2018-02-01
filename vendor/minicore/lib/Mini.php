<?php

namespace minicore\lib;

/**
 * @author lixiao
 *
 */
/**
 * Class Mini
 * @package minicore\lib
 */
/**
 * Class Mini
 * @package minicore\lib
 */
class Mini
{

    /**
     * @var  \minicore\lib\MiniApp $app
     *
     */
    public static $app;

    /**
     * Mini constructor.
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public static function createObj($name)
    {
        $reflectionClass = new \ReflectionClass($name);
        $reflectionMethod = $reflectionClass->getConstructor();
        if ($reflectionClass->getConstructor() && $paremeters = $reflectionClass->getConstructor()->getParameters()) {
            $actualParameters = array();
            foreach ($paremeters as $parameter) {

                $className = $parameter->getClass()->getName();
                if (class_exists($className)) {
                    $actualParameters[$parameter->getName()] = static::creatObj($className);
                }
            }
//            var_dump($name, $actualParameters);
            $obj = $reflectionClass->newInstanceArgs($actualParameters);
        } else {
            $obj = $reflectionClass->newInstance();
        }
        return $obj;
    }

    public static function creatObjByArgs($classname, $args)
    {

        if (class_exists($classname)) {

            $reflectionClass = new \ReflectionClass($classname);
            $reflectionMethod = $reflectionClass->getConstructor();
            if ($reflectionClass->getConstructor() && $paremeters = $reflectionClass->getConstructor()->getParameters()) {
                $actualParameters = array();
                foreach ($paremeters as $parameter) {
                    echo $parameter->name;
                    $actualParameters[$parameter->name] = $args[$parameter->name];
                }
                var_dump($actualParameters);
                $obj = $reflectionClass->newInstanceArgs($actualParameters);
            }


            /*$reflectionClass = new \ReflectionClass($classname);
            $obj = $reflectionClass->newInstanceArgs($args);*/
            return $obj;
        }
    }

    public static function creatObjByReflectionClass($reflectionClass)
    {

    }
}


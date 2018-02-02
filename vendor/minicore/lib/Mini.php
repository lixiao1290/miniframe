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
     *给出类名，获得对象
     */
    public static function createObj($name)
    {
        $reflectionClass = new \ReflectionClass($name);
        $reflectionMethod = $reflectionClass->getConstructor();
        if ($reflectionClass->getConstructor()) {
            $paremeters = $reflectionClass->getConstructor()->getParameters();
            if ($paremeters) {
                $actualParameters = array();
                foreach ($paremeters as $parameter) {
                    $className = $parameter->getClass()->getName();
                    try {
                        if (class_exists($className)) {
                            $actualParameters[] = static::creatObj($className);
                        } else {
                            throw new \Exception("class " . $classname . "  not found");
                        }
                    } catch (\Exception $e) {
                        echo $e->getMessage();
                    }
                }
//            var_dump($name, $actualParameters);
                $obj = $reflectionClass->newInstanceArgs($actualParameters);
            } else {
                $obj = $reflectionClass->newInstance();
            }
        } else {
            $obj = $reflectionClass->newInstanceWithoutConstructor();
        }
        return $obj;
    }

    /**
     * 给粗参数类名，返回对象
     * @param $classname
     * @param $args
     * @return object
     */
    public static function creatObjByArgs($classname, $args)
    {
        try {
            if (class_exists($classname)) {
                $reflectionClass = new \ReflectionClass($classname);
                $reflectionMethod = $reflectionClass->getConstructor();
                if ($reflectionClass->getConstructor()) {
                    $paremeters = $reflectionClass->getConstructor()->getParameters();
                    if ($paremeters) {
                        $actualParameters = array();
                        foreach ($paremeters as $parameter) {
                            $actualParameters[] = $args[$parameter->name];
                        }
                        $obj = $reflectionClass->newInstanceArgs($actualParameters);
                        return $obj;
                    } else {
                        /*todo*/
                    }
                }
            } else {
                throw new \Exception("class " . $classname . "  not found");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * @param $reflectionClass
     */
    public static function creatObjByReflectionClass($reflectionClass)
    {

    }
}


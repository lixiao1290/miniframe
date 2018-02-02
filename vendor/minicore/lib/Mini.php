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
        if ($reflectionClass->getConstructor()) {/*if the class  has   constructor*/
            $parameter = $reflectionClass->getConstructor()->getParameters();
            if ($parameter) { /*if the constuctor  has parameters*/
                $actualParameters = array();
                foreach ($parameter as $parameter) {
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
            } else { /*if the constuctor  has not parameters*/
                $obj = $reflectionClass->newInstance();
            }
        } else { /*if the class  has not constructor*/
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
                if ($reflectionClass->getConstructor()) { /*if the class  has   constructor*/
                    $parameters = $reflectionClass->getConstructor()->getParameters();
                    if ($parameters) {
                        $actualParameters = array();
                        foreach ($parameters as $parameter) {
                            $actualParameters[] = $args[$parameter->name];
                        }
                        $obj = $reflectionClass->newInstanceArgs($actualParameters);

                    } else { /*if the class  has no  parameters*/
                        /*todo*/
                        $obj = $reflectionClass->newInstance();
                    }
                } else { /** if the class  has no  constructor*/
                    $obj = $reflectionClass->newInstanceWithoutConstructor();
                }
            } else {
                throw new \Exception("class " . $classname . "  not found");
            }
            return $obj;
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


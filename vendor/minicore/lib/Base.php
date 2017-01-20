<?php
namespace minicore\lib;

abstract class Base implements \Iterator
{
    public static $obj;
    
    /**
     *
     * {@inheritdoc}
     *
     * @see Iterator::current()
     */
    public function current()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Iterator::key()
     */
    public function key()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Iterator::next()
     */
    public function next()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        // TODO Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Iterator::valid()
     */
    public function valid()
    {
        // TODO Auto-generated method stub
    }

    public function getClassFile()
    {
        $class = new \ReflectionClass(static::class);
        return $class->getFileName();
    }


    /**
     * @param unknown 初始化对象
     */
    public function miniObj($members=null)
    {
        if (empty($members)) {
            $members=Mini::$app->getExtention(static::class);
    
        }
        foreach ($members as $key => $value) {
            if (property_exists(get_called_class(), $key))
                $this->$key = $value;
        }
    
    }
    
    /**
     * 初始化静态属性
     * @param unknown $members
     */
    public static function miniObjStatic($members)
    {
        if (empty($members)) {
            $members=Mini::$app->getExtention(static::class);
    
        }
        foreach ($members as $key => $value) {
            if (property_exists(get_called_class(), $key))
                static::$$key = $value;
        }
    }
    

    public function PropFuncExist($name)
    {
        return property_exists(static::class, $name) || method_exists(static::class, $name);
    }
}


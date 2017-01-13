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
        $class=new \ReflectionClass(static::class);
        return $class->getFileName();
    }

    public function obj($members)
    {
         
        foreach ($members as $key=>$value) {
        	if(property_exists(get_called_class(), $key))
            $this->$key=$value;
        }
    }
    public static function objStatic($members)
    {
        foreach ($members as $key=>$value) {
        	if(property_exists(get_called_class(), $key))
            static::$$key=$value;
        }
        
    }
    
    public function PropFuncExist($name)
    {
    	return property_exists(static::class, $name)||method_exists(static::class, $name);
    }
}


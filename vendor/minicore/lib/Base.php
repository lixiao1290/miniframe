<?php
namespace minicore\lib;

abstract class Base implements \Iterator
{

    private $instance;
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
        $class=new \ReflectionClass(get_called_class());
        return $class->getFileName();
    }

    public function obj($members)
    {
        self::$instance=new static();
        foreach ($members as $key=>$value) {
            self::$instance->$key=$value;
        }
        return self::$instance;
    }
    
    
}


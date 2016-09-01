<?php
namespace minicore\lib;

abstract class Base implements \Iterator
{
    /**
     * {@inheritDoc}
     * @see Iterator::current()
     */
    public function current()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see Iterator::key()
     */
    public function key()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see Iterator::next()
     */
    public function next()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see Iterator::valid()
     */
    public function valid()
    {
        // TODO Auto-generated method stub
        
    }

    public function getClassFile()
    {
        static::staticFile(); 
    }
     public static  function staticFile()
     {
         return '.q'. __FILE__;echo '34342';
     }
}


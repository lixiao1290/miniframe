<?php
namespace MiniCore\Interfaces;

interface  MiniBase
{
    const version='1.0';
    public function __construct()
    {
        
    }
    public function  getVersion()
    {
        return self::version;
    }
}

?>
<?php
namespace minicore\helper;

use minicore\config\ConfigBase;

/**
 * @author lixiao
 *数据库操作类
 */
class Db extends Helper 
{
    public $sqlLast;
    public $pdo;
    public $data;
    public $dsn;
    public $config;
    public $statement;
    public function __construct()
    {
        
    }
     
    
}


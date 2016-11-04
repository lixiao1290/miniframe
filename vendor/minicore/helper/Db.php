<?php
namespace minicore\helper;

use minicore\traits\SingleInstance;

/**
 *
 * @author lixiao
 *         数据库操作类
 */
class Db extends Helper
{

    private static $sqlLast;

    private static $pdo;

    private static $db;

    private static $table;

    private static $dsn;

    private static $config;

    private static $statement;

    private static $fields;

    private static $host;
    public  static $user;
    public static  $pwd;
    
     
    
    private static $type='mysql';
    use SingleInstance;
    
    public static function db($dbname)
    {
        self::$db = $dbname;
        return self::Instance();
    }

    public  function table($table)
    {
        self::$table = $table;
        return self::Instance();
    }

    public  function field($fields)
    {
        self::$fields = $fields;
        return self::Instance();
    }

    public  function debug()
    {
        var_dump(self::$db, self::$fields, self::$table);
    }

    private static function pdoInit()
    {
        self::$dsn = self::$type . ':' . 'database=' . self::$db . ';host=' . self::$host;
        self::$pdo = new \PDO(self::$dsn,self::$user,self::$pass);
    }

    private static function creatParameters($array)
    {
        $rs = [];
        foreach ($array as $key => $value) {
            $rs[':'.$key ] = $value;
        }
         
        return $rs;
    }

    public static function insert($data)
    {
        try {
            $pars = self::creatParameters($data);
            $fields=array_keys($data);
            if(empty(self::$table)) {
                throw new \Exception('在添加数据时，未指定表名！');
            }
            if(empty($data)) {
                throw new \Exception('在添加数据时，未给定数据格式化的数组！');
            }
            $sql='insert into '.self::$table.'('.implode(',', array_keys($data)).')values('.implode(',', array_keys($pars)).')';
            echo $sql;
            self::pdoInit();
            self::$statement=self::$pdo->prepare($sql);
            self::$statement->execute($pars);
            
//             var_dump(self::$statement->errorInfo());
        }catch (\Exception $e){
            echo $e->getMessage();
        }
                
    }

    public static function delete()
    {}

    public static function update()
    {}

    public static function select()
    {}

    public static function exec($sql)
    {
        self::pdoInit();
        self::$pdo->exec($sql);
    }
}


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

    private $sqlLast;

    private $pdo;

    private $db;

    private $table;

    private $dsn;

    private $config;

    private $statement;

    private $fields;

    private $sql;

    private $where;    /* array( array('字段','=','值') ,) */
    public $host = 'localhost';

    public $user;

    public $pwd;
    
    public $self;
    private $type = 'mysql';
    use SingleInstance;

    public static function db($dbname)
    {
        self::$instance->db = $dbname;
        return self::Instance();
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function field($fields)
    {
        self::$instance->fields = $fields;
        return self::Instance();
    }

    public function debug()
    {
        var_dump(self::$instance->db, self::$instance->fields, self::$instance->table);
    }

    private static function pdoInit()
    {
        self::$instance->dsn = self::$instance->type . ':' . 'dbname=' . self::$instance->db . ';host=' . self::$instance->host;
        self::$instance->pdo = new \PDO(self::$instance->dsn, self::$instance->user, self::$instance->pwd);
    }

    private static function creatParameters($array)
    {
        $rs = [];
        foreach ($array as $key => $value) {
            $rs[':' . $key] = $value;
        }
        
        return $rs;
    }

    public static function insert($data)
    {
        try {
            $pars = self::creatParameters($data);
            var_dump($pars);
            $fields = array_keys($data);
            if (empty(self::$instance->table)) {
                throw new \Exception('在添加数据时，未指定表名！');
            }
            if (empty($data)) {
                throw new \Exception('在添加数据时，未给定数据格式化的数组！');
            }
            $sql = 'INSERT INTO ' . self::$instance->table . '(' . implode(',', array_keys($data)) . ')values(' . implode(',', array_keys($pars)) . ')';
            echo $sql;
            self::pdoInit();
            self::$instance->statement = self::$instance->pdo->prepare($sql);
            self::$instance->statement->execute($pars);
            
            var_dump('<pre>', self::$instance->pdo->lastInsertId(), self::$instance->statement->debugDumpParams());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function delete()
    {}

    public static function update()
    {}

    public static function select()
    {
        $sql = 'SELECT ' . self::$instance->fields . ' from ' . self::$instance->table;
        self::$instance->pdoInit();
        self::$instance->statement=self::$instance->pdo->prepare($sql);
        
    }

    public static function exec($sql)
    {
        self::pdoInit();
        self::$instance->pdo->exec($sql);
    }
    public static function where(array $where)
    {
        
    }
}


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

    private $where;

    private $pars;

    private $lastInsertId;
    private $wherepars;

    /* array( array('字段','=','值') ,) */
    public $host = 'localhost';

    public $user = 'root';

    public $pwd = 'root';

    public $self;

    private $type = 'mysql';
    use SingleInstance;

    public static function db($dbname)
    {
        return self::instance(array(
            'db' => $dbname
        ));
    }

    public static function table($table)
    {
        return self::instance(array(
            'table' => $table
        ));
    }

    public function field($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function debug()
    {
        var_dump(self::$instance->db, self::$instance->fields, self::$instance->table);
    }

    private function pdoInit()
    {
        try {
            if (is_object($this->pdo)) {
                return $this->pdop;
            } else {
                $this->dsn = self::$instance->type . ':' . 'dbname=' . self::$instance->db . ';host=' . self::$instance->host;
                $this->pdo = new \PDO($this->dsn, $this->user, $this->pwd);
                return $this->pdo;
            }
        } catch (\PDOException $e) {
            echo $e->errorInfo;
        }
    }

    private function creatParameters($array)
    {
        $rs = [];
        foreach ($array as $key => $value) {
            $rs[':' . $key] = $value;
        }
        
        return $rs;
    }

    public function insert($data)
    {
        try {
            $pars = $this->creatParameters($data);
            // var_dump($pars);
            $fields = array_keys($data);
            if (empty(self::$instance->table)) {
                throw new \Exception('在添加数据时，未指定表名！');
            }
            if (empty($data)) {
                throw new \Exception('在添加数据时，未给定数据格式化的数组！');
            }
            $sql = 'INSERT INTO ' . self::$instance->table . '(' . implode(',', array_keys($data)) . ')values(' . implode(',', array_keys($pars)) . ')';
            // echo $sql;
            $pdo = self::pdoInit();
            $statement = $pdo->prepare($sql);
            $statement->execute($pars);
            $this->lastInsertId = $pdo->lastInsertId();
            var_dump('<pre>', self::$instance->pdo->lastInsertId(), self::$instance->statement->debugDumpParams());
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete()
    {}

    public function update()
    {}

    public function select($feilds)
    {
        try {
            
            $sql = 'SELECT ' . $feilds . ' from ' . $this->table;
            $pdo = $this->pdoInit();
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo $e->errorInfo;
        }
    }

    public static function exec($sql, $pars)
    {
        self::pdoInit();
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($pars);
    }

    public static function where(array $where)
    {
        try {
            if(empty($where[0]))    {
                throw new \Exception('where条件字段未给出');
            }
            if(empty($where[1])) {
                throw new \Exception('where条件类型未给出');
            }
            if(empty($where[2])) {
                throw new \Exception('where条件字段的值未给出');
            } else {
                
                $this->where.=' '.$where[0].' '.$where[1].' '.$where[2];
                $this->wherepars[':'.$where[0]]=$where[2];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


<?php
namespace minicore\helper;

/**
 *
 * @author lixiao
 *         数据库操作类
 */
/**
 * Class Db
 * @package minicore\helper
 */
class Db extends Helper
{

    /**
     * @var
     */
    private $sqlLast;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var string $db
     */
    protected $db;

    /**
     * @var string
     */
    private $table;

    private $dsn;

    private $config;

    /**
     * @var \PDOStatement $statement
     */
    private $statement;

    private $fields;

    private $selectSql;

    private $where;
    /**
     * @var Db
     */
    protected static $staticObj;
    /* array( array('字段','=','值') ,) */
    private $pars;

    private $wherepars;

    public $fetchstyle = \PDO::FETCH_ASSOC;

    public $host;

    public $user;

    public $pwd;

    public $self;

    private $type = 'mysql';

    public $sql;

    public function __construct($host,$user,$pwd,$type,$db,$port)
    {
        $this->host=$host;
        $this->user=$user;
        $this->pwd=$pwd;
        $this->type=$type;
        $this->db=$db;
        $this->port=$port;
    }
    /**
     *
     * @return the $wherepars
     */
    public function getWherepars()
    {
        return self::$staticObj->wherepars;
    }

    /**
     *
     * @param field_type $wherepars
     */
    public function setWherepars($wherepars)
    {
        self::$staticObj->wherepars = $wherepars;
    }

    /**
     *
     * @return the $sql
     */
    public function getSql()
    {
        return self::$staticObj->sql;
    }

    /**
     *
     * @param string $sql
     */
    public function setSql($sql)
    {
        self::$staticObj->sql = $sql;
    }

    public $executePars;

    /**
     *
     * @return the $executePars
     */
    public function getExecutePars()
    {
        return self::$staticObj->executePars;
    }

    /**
     *
     * @param field_type $executePars
     */
    public function setExecutePars($executePars)
    {
        self::$staticObj->executePars = $executePars;
    }

    /**
     *
     * @return the $fields
     */
    public function getFields()
    {
        return self::$staticObj->fields;
    }

    /**
     *
     * @param
     *            Ambigous <string, unknown> $fields
     */
    public function setFields($fields)
    {
        self::$staticObj->fields = $fields;
    }

    /**
     *
     * @return the $pdo
     */
    public function getPdo()
    {
        if (is_object(self::$staticObj->pdo)) {
            return self::$staticObj->pdo;
        } else {
            return self::$staticObj->pdoInit();
        }
    }

    /**
     *
     * @param \PDO $pdo
     */
    public function setPdo($pdo)
    {
        self::$staticObj->pdo = $pdo;
    }

    public static function database($db)
    {


//        $static->db = $db;
        self::$staticObj=self::ObjInit($db);
        return self::$staticObj;
    }

    /**
     * @param $table 表名
     * @param $table tablename
     * @return self::$staticObj
     */
    public function table($table)
    {
        self::$staticObj->table = $table;
        return self::$staticObj;
    }

    public function field($fields)
    {
        self::$staticObj->fields = $fields;
        return self::$staticObj;
    }

    public function debug()
    {
        var_dump(self::$staticObj->db, self::$staticObj->fields, self::$staticObj->table, self::$staticObj->pdo->errorInfo(), self::$staticObj->statement->errorInfo());
    }

    public function asObj()
    {
        self::$staticObj->fetchstyle = \PDO::FETCH_OBJ;
        return self::$staticObj;
    }

    public function asClass()
    {
        self::$staticObj->fetchstyle = \PDO::FETCH_CLASS;
        return self::$staticObj;
    }

    public function asArray()
    {
        self::$staticObj->fetchstyle = \PDO::FETCH_ASSOC;
        return self::$staticObj->select();
    }

    private function pdoInit()
    {
        try {
            if (is_object(self::$staticObj->pdo)) {
                return self::$staticObj->pdo;
            } else {
                self::$staticObj->dsn = self::$staticObj->type . ':' . 'dbname=' . self::$staticObj->db . ';host=' . self::$staticObj->host;
                echo self::$staticObj->dsn ;
                self::$staticObj->setPdo((new \PDO(self::$staticObj->dsn, self::$staticObj->user, self::$staticObj->pwd)));
                return self::$staticObj->pdo;
            }
        } catch (\PDOException $e) {
            echo $e->errorInfo;
        }
    }

    /**
     * 解析数组为pdoStatement可以用的数组 类似 array(':calories' => 175, ':colour' => 'yellow')
     * @param $array
     * @return array
     */
    private function creatPars($array)
    {
        $rs = [];
        foreach ($array as $key => $value) {
            $rs[':' . $key] = $value;
        }

        return $rs;
    }

    /**
     *添加数据
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function insert($data)
    {
        try {
            $pars = self::$staticObj->creatPars($data);
            // var_dump($pars);
            $fields = array_keys($data);
            if (empty(self::$staticObj->table)) {
                throw new \Exception('在添加数据时，未指定表名！');
            }
            if (empty($data)) {
                throw new \Exception('在添加数据时，未给定数据格式化的数组！');
            }
            $sql = <<<SQL
                INSERT INTO self::$staticObj->table(implode(',', array_keys($data))values(implode(',', array_keys($pars))
SQL;

            $pdo = self::pdoInit();
            $statement = $pdo->prepare($sql);
            $statement->execute($pars);
            return $pdo->lastInsertId();
            if (\PDO::ERR_NONE != $statement->errorCode()) {
                return self::$staticObj->pdo->lastInsertId();
            } else {
                var_dump($statement->debugDumpParams());
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete()
    {
        if (empty(self::$staticObj->where) || empty(self::$staticObj->wherepars)) {
            echo '未给出条件';
        }
        if (empty(self::$staticObj->table)) {
            echo '未给出表';
        } else {
            $sql = <<<SQL
            delete from self::$staticObj->table where self::$staticObj->where 
SQL;
            echo $sql;
        }
    }

    public function SqlizePars($pars)
    {
        $str = <<<SQL
set
SQL;
        $keys = array_keys($pars);
        $end = count($keys) - 1;
        foreach ($keys as $k => $vo) {
            if ($k == $end) {
                $str .= <<<SQL
 $vo = :$vo
SQL;
            } else {

                $str .= <<<SQL
 $vo = :$vo,
SQL;
            }
        }
        return $str;
    }

    /**
     * 修改
     * @param $pars
     */
    public function update($pars)
    {
        if (empty(self::$staticObj->where) || empty(self::$staticObj->wherepars)) {
            echo '未给出条件';
        }
        if (empty(self::$staticObj->table)) {
            echo '未给出表';
        } else {
            $parsStr = self::$staticObj->SqlizePars($pars);
            self::$staticObj->setSql(<<<SQL
            update self::$staticObj->table $parsStr where self::$staticObj->where
SQL
);
            $pars = array_merge(self::$staticObj->creatPars($pars), self::$staticObj->getWherepars());
            echo self::$staticObj->getSql();
            var_dump($pars);
            self::$staticObj->execute(self::$staticObj->getSql(), $pars);
            self::$staticObj->debug();
        }
    }

    public function parseFields($fields)
    {
        if (is_array($fields)) {
            foreach ($fields as $k => $v) {
                $fieldStr .= "{$k} as {$v} "; // key 字段 value as
            }
        } else {
            $fieldStr = $fields;
        }
        return $fieldStr;
    }
    /**
     * @param string $fields
     * @return mixed
     */
    public function select($fields = '*')
    {

        try {
            $fieldStr = self::$staticObj->parseFields($fields);
            self::$staticObj->setSql(<<<SQL
            SELECT   $fieldStr   from   self::$staticObj->table
SQL
);
            // echo self::$staticObj->selectSql;
            if (! empty(self::$staticObj->wherepars)) {
                self::$staticObj->selectSql .= ' where ' . self::$staticObj->where;
            }
            self::$staticObj->exec(self::$staticObj->getSql(), self::$staticObj->getWherepars());
            return self::$staticObj->statement->fetchAll(self::$staticObj->fetchstyle);
        } catch (\PDOException $e) {
            echo $e->errorInfo;
        }
    }

    public function where(array $where)
    {
        try {
            if (empty($where[0])) {
                throw new \Exception('where条件字段未给出');
            }
            if (empty($where[1])) {
                throw new \Exception('where条件类型未给出');
            }
            if (empty($where[2])) {
                throw new \Exception('where条件字段的值未给出');
            } else {

                self::$staticObj->where .= ' ' . $where[0] . ' ' . $where[1] . ' :' . $where[0];
                self::$staticObj->wherepars[':' . $where[0]] = $where[2];
            }
            return self::$staticObj;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return self::$staticObj;
    }

    public function filteWhere(array $where)
    {
        if (! empty($where)) {
            try {
                if (empty($where[0])) {
                    throw new \Exception('where条件字段未给出');
                }
                if (empty($where[1])) {
                    throw new \Exception('where条件类型未给出');
                }
                if (empty($where[2])) {
                    throw new \Exception('where条件字段的值未给出');
                } else {

                    self::$staticObj->where .= ' ' . $where[0] . ' ' . $where[1] . ' :' . $where[0];
                    self::$staticObj->wherepars[':' . $where[0]] = $where[2];
                }
                return self::$staticObj;
            } catch (Exception $e) {
                echo $e->getMessage();
                exit();
            } catch (\PDOException $e) {
                echo $e->getMessage();
                exit();
            }
        }

        return self::$staticObj;
    }

    public function exec($sql, $pars = NULL)
    {
        self::$staticObj->pdoInit();
        self::$staticObj->statement = self::$staticObj->pdo->prepare($sql);
        self::$staticObj->statement->execute($pars);
    }

    /**
     * 执行数据库查询
     *
     * @return boolean
     */
    public function execute($sql, $pars)
    {
        try {
            $pdo = self::$staticObj->pdoInit();
            self::$staticObj->statement = $pdo->prepare(self::$staticObj->sql);
            return self::$staticObj->statement->execute($pars);
        } catch (Exception $e) {
            echo $e->getMessage();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


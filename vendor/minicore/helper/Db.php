<?php

namespace minicore\helper;

use minicore\lib\Mini;

/**
 *
 * @author lixiao
 *         数据库操作类
 */
class Db extends Helper {
	private $sqlLast;
	private $pdo;
	public  $db;
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
	public $fetchstyle = \PDO::FETCH_ASSOC;
	/* array( array('字段','=','值') ,) */
	public $host = 'localhost';
	public $user = 'root';
	public $pwd = 'root';
	public $self;
	private $type = 'mysql';
	public static function database($db) {
		 
		$static= new static();
		if(is_array($db)) {
			
		} else {
			if(Mini::$app->getConfig('db')) {
				$static->obj(Mini::$app->getConfig('db'));
			}
		}
		$static->db = $db;
		return $static;
	}
	public function table($table) {
		 
		$this->table = $table;
		return $this;
	}
	public function field($fields) {
		$this->fields = $fields;
		return $this;
	}
	public function debug() {
		var_dump ( $this->db, $this->fields, $this->table );
	}
	public function asObj() {
		$this->fetchstyle = \PDO::FETCH_OBJ;
		return $this;
	}
	public function asClass() {
		$this->fetchstyle = \PDO::FETCH_CLASS;
		return $this;
	}
	public function asAsosoc() {
		$this->fetchstyle = \PDO::FETCH_ASSOC;
		return $this;
	}
	private function pdoInit() {
		try {
			if (is_object ( $this->pdo )) {
				return $this->pdop;
			} else {
				$this->dsn = $this->type . ':' . 'dbname=' . $this->db . ';host=' . $this->host;
				$this->pdo = new \PDO ( $this->dsn, $this->user, $this->pwd );
				return $this->pdo;
			}
		} catch ( \PDOException $e ) {
			echo $e->errorInfo;
		}
	}
	private function creatParameters($array) {
		$rs = [ ];
		foreach ( $array as $key => $value ) {
			$rs [':' . $key] = $value;
		}
		
		return $rs;
	}
	public function insert($data) {
		try {
			$pars = $this->creatParameters ( $data );
			// var_dump($pars);
			$fields = array_keys ( $data );
			if (empty ( $this->table )) {
				throw new \Exception ( '在添加数据时，未指定表名！' );
			}
			if (empty ( $data )) {
				throw new \Exception ( '在添加数据时，未给定数据格式化的数组！' );
			}
			$sql = 'INSERT INTO ' . $this->table . '(' . implode ( ',', array_keys ( $data ) ) . ')values(' . implode ( ',', array_keys ( $pars ) ) . ')';
			// echo $sql;
			$pdo = self::pdoInit ();
			$statement = $pdo->prepare ( $sql );
			$statement->execute ( $pars );
			$this->lastInsertId = $pdo->lastInsertId ();
			// var_dump('<pre>', $this->pdo->lastInsertId(), $this->statement->debugDumpParams());
			if (\PDO::ERR_NONE != $statement->errorCode ()) {
				return $this->pdo->lastInsertId ();
			} else {
				var_dump ( $statement->debugDumpParams () );
			}
		} catch ( \PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function delete() {
	}
	public function update() {
	}
	public function select($feilds = '*') {
		try {
			
			$this->sql = 'SELECT ' . $feilds . ' from ' . $this->table . ' where ' . $this->where;
			$pdo = $this->pdoInit ();
			$statement = $pdo->prepare ( $sql );
			$statement->execute ( $this->wherepars ? $this->wherepars : null );
			$result = $statement->fetchAll ( $this->fetchstyle );
			return $result;
		} catch ( \PDOException $e ) {
			echo $e->errorInfo;
		}
	}
	public function exec($sql, $pars) {
		self::pdoInit ();
		$this->statement = $this->pdo->prepare ( $sql );
		$this->statement->execute ( $pars );
	}
	public function where(array $where) {
		try {
			if (empty ( $where [0] )) {
				throw new \Exception ( 'where条件字段未给出' );
			}
			if (empty ( $where [1] )) {
				throw new \Exception ( 'where条件类型未给出' );
			}
			if (empty ( $where [2] )) {
				throw new \Exception ( 'where条件字段的值未给出' );
			} else {
				
				$this->where .= ' ' . $where [0] . ' ' . $where [1] . ' :' . $where [0];
				$this->wherepars [':' . $where [0]] = $where [2];
			}
			return $this;
		} catch ( Exception $e ) {
			echo $e->getMessage ();
			exit ();
		} catch ( \PDOException $e ) {
			echo $e->getMessage ();
			exit ();
		}
		return $this;
	}
	public function getWherePar() {
		// var_dump( $this->wherepars);
	}
	public function execute() {
		$pdo = $this->pdoInit ();
		$statement = $pdo->prepare ( $this->sql );
		$statement->errorInfo ();
		return $statement->execute ();
	}
}


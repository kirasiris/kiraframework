<?php
/* 
 *  PDO DATABASE CLASS
 *  Connects Database Using PDO
 *  Creates Prepeared Statements
 * 	Binds params to values
 *  Returns rows and results
 */

namespace kira\core;

use PDO;
use PDOException;
use Exception;

// use function app\helpers\basePath;

class Database
{
	public $connection;
	//private $host = DB_HOST;
	// private $user = DB_USER;
	// private $pass = DB_PASS;
	// private $dbname = DB_NAME;

	private $dbh;
	private $error;
	private $stmt;

	public function __construct($config)
	{
		// Set DSN
		$config = require basePath('config/db.php');

		$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		];


		// Create a new PDO instanace
		try {
			$this->connection = new PDO($dsn, $config['username'], $config['password'], $options);
		}		// Catch any errors
		catch (PDOException $e) {
			// $this->error = $e->getMessage();
			// echo $this->error;
			throw new Exception("Database connection failed: {$e->getMessage()}");
		}
	}

	// Prepare statement with query
	public function query($query, $params = [])
	{
		try {
			$this->stmt = $this->connection->prepare($query);

			// Bind named params
			foreach ($params as $param => $value) {
				$this->stmt->bindValue(':' . $param, $value);
			}

			// Execute query
			$this->stmt->execute();

			return $this->stmt;
		} catch (PDOException $e) {
			// $this->error = $e->getMessage();
			// echo $this->error;
			throw new Exception("Query failed to execute: {$e->getMessage()}");
		}
	}

	// Bind values
	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	// Execute the prepared statement
	public function execute()
	{
		return $this->stmt->execute();
	}

	// Get result set as array of objects
	public function resultset()
	{
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	// Get single record as object
	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	// Get record row count
	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

	// Returns the last inserted ID
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}
}
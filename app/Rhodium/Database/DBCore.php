<?php 

namespace Rhodium\Database;

use \PDO;
use Rhodium\Database\DatabaseConfig;

/**
 * Database Core
 *
 * @author  	Ewan Valentine <ewan.valentine89@gmail.com>
 * @copyright 	Ewan Valentine 2013
 */
class DBCore extends PDO
{

	private $config;
	private $dbname;
	private $dbuser;
	private $dbpass;
	private $dbhost;

	public function __construct()
	{
		$this->config = new DatabaseConfig();
		$this->dbtype = $this->config->dbtype;
		$this->dbname = $this->config->dbname;
		$this->dbuser = $this->config->dbuser;
		$this->dbpass = $this->config->dbpass;
		$this->dbhost = $this->config->dbhost;

		try {
			$dsn = 'mysql:host='.$this->dbhost.';dbname='.$this->dbname;

			parent::__construct($dsn, $this->dbuser, $this->dbpass);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
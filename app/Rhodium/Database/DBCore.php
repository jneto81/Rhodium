<?php 

namespace Rhodium\Database;

use \PDO;
use Rhodium\Config\DatabaseConfig;

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
		$this->dbtype = $this->config->getDbType();
		$this->dbname = $this->config->getDbName();
		$this->dbuser = $this->config->getDbUser();
		$this->dbpass = $this->config->getDbPass();
		$this->dbhost = $this->config->getDbHost();

		try {
			$dsn = 'mysql:host='.$this->dbhost.';dbname='.$this->dbname;

			parent::__construct($dsn, $this->dbuser, $this->dbpass);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
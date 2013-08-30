<?php 

namespace YourAppName\Models;

use Rhodium\BaseModel;

class TestModel extends BaseModel
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getData()
	{
		return self::$app['db']->fetchAssoc('SELECT * FROM test');
	}
}
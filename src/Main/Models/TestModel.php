<?php 

namespace Main\Models;

use Rhodium\BaseModel;

class TestModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function test()
	{
		$value = User::find_by_fname('Ewan');

		return $value;
	}
}

/** User class has to extend ActiveRecord\Mode */
class User extends \ActiveRecord\Model
{

}
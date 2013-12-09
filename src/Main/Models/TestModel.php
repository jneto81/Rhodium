<?php 

namespace Main\Models;

use Rhodium\BaseModel;

class TestModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function test( $param )
	{
		$value = User::find_by_fname( $param );

		return $value;
	}

	public function lastName( $param )
	{
		$value = User::find_by_lname( $param );

		return $value;
	}
}

/** User class has to extend ActiveRecord\Mode */
class User extends \ActiveRecord\Model
{

}
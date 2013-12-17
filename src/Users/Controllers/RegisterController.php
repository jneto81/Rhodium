<?php 

namespace Users\Controllers;

use Sentry;
use Rhodium\BaseController;

class RegisterContoller extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function register()
	{
		$user = Sentry::createUser(array(
			'email'		=> $email,
			'password'	=> $password
		));

		if ( $user ) {
			return 'User created.';
		} else {
			return false;
		}
	}
}
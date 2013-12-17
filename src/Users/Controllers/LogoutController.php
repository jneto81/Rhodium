<?php 

namespace Users\Controllers;

use Sentry;
use Rhodium\BaseController;

class LogoutController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function logout()
	{
		Sentry::logout();

		return self::$app->redirect( '/' );
	}
}
<?php 

namespace Users\Controllers;

use Sentry;
use Rhodium\BaseController;

class LoginController extends BaseController
{
	public function __consruct()
	{
		parent::__consruct();
	}

	public function login()
	{
		return $this->view( 'Users:users_login' );
	}

	public function loginAction( $email, $password )
	{
		$credentials = array (
			'email'		=> $email,
			'password'	=> $password
		);

		try {
			$user = Sentry::authenticate( $credentials, false );

			if ( $user ) {
				Sentry::loginAndRemember( $user );
				return self::$app->redirect( '/' );
			}

		} catch ( \Exception $e ) {
			return self::$app->redirect( '/' );
		}
	}
}
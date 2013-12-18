<?php 

namespace Rhodium\Commands;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Rhodium;

use Users\Models\User;

class CreateUser extends Command
{
	protected function configure()
	{
		$this
			->setName( 'r:c:u' )
			->setDescription( 'Adds a user' )
			->addArgument( 'fname', InputOption::VALUE_REQUIRED, 'Enter a first name.' )
			->addArgument( 'lname', InputOption::VALUE_REQUIRED, 'Enter a last name.' )
			->addArgument( 'email', InputOption::VALUE_REQUIRED, 'Enter an email address.' )
			->addArgument( 'password', InputOption::VALUE_REQUIRED, 'Enter a password (plain text).' )
			->addArgument( 'role', InputOption::VALUE_OPTIONAL, 'Enter a role id.' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$fname = $input->getArgument( 'fname' );
		$lname 	   = $input->getArgument( 'lname' );
		$email    = $input->getArgument( 'email' );
		$password     = $input->getArgument( 'password' );
		$role  = $input->getArgument( 'role' ); 

		$user = new User();

		$user->fname = $fname;
		$user->lname = $lname;
		$user->email = $email;
		$user->password = sha1( $password );

		if ( isset( $role ) ) {
			$user->role_id = $role;
		} else {
			$user->role_id = 1;
		}

		$user->save();
	}
}
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

class CreateRoute extends Command
{
	protected function configure()
	{
		$this
			->setName( 'r:a:r' )
			->setDescription( 'Adds a route' )
			->addArgument( 'route_name', InputOption::VALUE_REQUIRED, 'Enter a route name.' )
			->addArgument( 'path', InputOption::VALUE_REQUIRED, 'Enter a path.' )
			->addArgument( 'bundle', InputOption::VALUE_REQUIRED, 'Enter a bundle name.' )
			->addArgument( 'class', InputOption::VALUE_REQUIRED, 'Enter a class name.' )
			->addArgument( 'function', InputOption::VALUE_REQUIRED, 'Enter a function name.' )
			->addArgument( 'methods', InputOption::VALUE_REQUIRED, 'Enter a method, or multiple methods separated with a pipe character.' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$routeName = $input->getArgument( 'route_name' );
		$path 	   = $input->getArgument( 'path' );
		$bundle    = $input->getArgument( 'bundle' );
		$class     = $input->getArgument( 'class' );
		$function  = $input->getArgument( 'function' ); 
		$methods   = $input->getArgument( 'methods' );

		if ( isset( $methods ) ) {
			$newRoute = 
			"\n\n$routeName:\n  path: /$path\n  defaults: { _controller: '".$bundle."\Controllers\\".$class."::".$function."' }\n  methods: [$methods]";
		} else {
			$newRoute = "\n\n$routeName:\n  path: /$path\n  defaults: { _controller: '".$bundle."\Controllers\\".$class."::".$function."' }";
		}

		$my_file  = './app/config/routes.yml';

		file_put_contents( $my_file, $newRoute, FILE_APPEND | LOCK_EX );
	}
}
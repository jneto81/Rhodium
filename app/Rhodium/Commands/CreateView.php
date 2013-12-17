<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium\Mailer;
use Rhodium;

class CreateView extends Command
{
	protected function configure()
	{
		$this	
			->setName( 'r:c:v' )
			->setDescription( 'Creates a view.' )
			->addArgument( 'class', null, InputOption::VALUE_REQUIRED, 'Enter a view name and bundle location, Bundle:Name' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$class = $input->getArgument( 'class' );
		$class = explode( ':', $class );

		$bundle = $class[0];
		$name = $class[1];

		$my_file = 'app/Rhodium/Commands/stubs/View.stub';

		$stub = fopen( $my_file, 'r' );
		$data = fread( $stub, filesize( $my_file ) );

		// $data = str_replace( '{{namespace}}' , $bundle, $data);
		// $data = str_replace( '{{class}}' , $name, $data);

		if ( !is_dir( 'src/'.$bundle ) ) {
			mkdir( 'src/'.$bundle );
		}

		if (  !is_dir('src/'.$bundle.'/Views' ) ) {
			mkdir( 'src/'.$bundle.'/Views' );
		}

		$handle = fopen( 'src/'.$bundle.'/Views/' . $name.'.html.twig', 'w' ) or die('Cannot open file: ' . $name.'.html.twig' );

		fwrite( $handle, $data );
	}
}
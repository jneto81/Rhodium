<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium\Mailer;
use Rhodium;

class CreateModel extends Command
{

	protected function configure()
	{
		$this	
			->setName( 'r:c:m' )
			->setDescription( 'Creates a model.' )
			->addArgument( 'class', null, InputOption::VALUE_REQUIRED, 'Enter a class name and bundle location, Bundle:Name' )
			->addArgument(
			    'cols',
			    InputArgument::IS_ARRAY,
			    'Specify your columns.'
			);
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$class = $input->getArgument( 'class' );
		$class = explode( ':', $class );

		$cols = $input->getArgument( 'cols' );

		



		$bundle = $class[0];
		$name = $class[1];

		$my_file = 'app/Rhodium/Commands/stubs/Model.stub';

		$stub = fopen( $my_file, 'r' );
		$data = fread( $stub, filesize( $my_file ) );

		$data = str_replace( '{{namespace}}' , $bundle, $data);
		$data = str_replace( '{{class}}' , $name, $data);

		foreach ( $cols as $col ) {
			explode( ':', $col );

			$properties[] = $col[0];
			$funs[] = $col[1]; 
		}

		$data = str_replace( '{{properties}}' , $bundle, $data);


		if ( !is_dir( 'src/'.$bundle ) ) {
			mkdir( 'src/'.$bundle );
		}

		if (  !is_dir('src/'.$bundle.'/Models' ) ) {
			mkdir( 'src/'.$bundle.'/Models' );
		}

		$handle = fopen( 'src/'.$bundle.'/Models/' . $name.'.php', 'w' ) or die('Cannot open file: ' . $name.'.php' );

		fwrite( $handle, $data );
	}
}
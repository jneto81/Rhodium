<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium\Mailer;
use Rhodium;

class CreateBundle extends Command
{

	protected function configure()
	{
		$this	
			->setName( 'r:c:b' )
			->setDescription( 'Creates a controller.' )
			->addArgument( 'class', null, InputOption::VALUE_REQUIRED, 'Enter a class name and mine location, Bundle:Name' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$class = $input->getArgument( 'class' );
		$class = explode( ':', $class );

		$bundle = $class[0];
		$name = $class[1];

		$my_file = 'app/Rhodium/Commands/stubs/Controller.stub';

		$stub = fopen( $my_file, 'r' );
		$data = fread( $stub, filesize( $my_file ) );

		$data = str_replace( '{{namespace}}' , $bundle.'\\'.$name, $data);
		$data = str_replace( '{{class}}' , $name, $data);

		if ( !is_dir( 'src/'.$bundle ) ) {
			mkdir( 'src/'.$bundle );
			mkdir( 'src/'.$bundle.'/Views' );
			mkdir( 'src/'.$bundle.'/Routes' );
		}

		if (  !is_dir('src/'.$bundle.'/Controllers' ) ) {
			mkdir( 'src/'.$bundle.'/Controllers' );
		}
		
		$handle = fopen( 'src/'.$bundle.'/Controllers/' . $name.'Controller.php', 'w' ) or die('Cannot open file: ' . $name.'Controller.php' );

		fwrite( $handle, $data );


		$my_file = 'app/Rhodium/Commands/stubs/Model.stub';

		$stub = fopen( $my_file, 'r' );
		$data = fread( $stub, filesize( $my_file ) );

		$data = str_replace( '{{namespace}}' , $bundle.'\\'.$name, $data);
		$data = str_replace( '{{class}}' , $name, $data);

		if ( !is_dir( 'src/'.$bundle ) ) {
			mkdir( 'src/'.$bundle );
		}

		if (  !is_dir('src/'.$bundle.'/Models' ) ) {
			mkdir( 'src/'.$bundle.'/Models' );
		}

		$handle = fopen( 'src/'.$bundle.'/Models/' . $name.'Model.php', 'w' ) or die('Cannot open file: ' . $name.'Model.php' );

		fwrite( $handle, $data );



		$my_file = 'app/Rhodium/Commands/stubs/View.stub';

		$stub = fopen( $my_file, 'r' );
		$data = fread( $stub, filesize( $my_file ) );

		if ( !is_dir( 'src/'.$bundle ) ) {
			mkdir( 'src/'.$bundle );
		}

		if (  !is_dir('src/'.$bundle.'/Views' ) ) {
			mkdir( 'src/'.$bundle.'/Views' );
		}

		$handle = fopen( 'src/'.$bundle.'/Views/' . strtolower( $name ).'_view.php', 'w' ) or die('Cannot open file: ' . $name.'_view.php' );

		fwrite( $handle, $data );
	}
}
<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium\Mailer;
use Rhodium;

class CreateController extends Command
{

	protected function configure()
	{
		$this	
			->setName( 'Rhodium:Create:Controller' )
			->setDescription( 'Creates a controller.' )
			->addArgument( 'class', null, InputOption::VALUE_REQUIRED, 'Enter a class name and mine location, Mine:Name' )
			->addOption( 'base', null, InputOption::VALUE_OPTIONAL, 'Does this extend the BaseController?' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$base = $input->getOption( 'base' );

		$class = $input->getArgument( 'class' );
		$class = explode( ':', $class );

		$mine = $class[0];
		$name = $class[1];

		$dir = __DIR__.'/../../src/' . $mine;

		$file =  __DIR__.'/../../src/' . $mine . '/Controllers/' . $name . 'Controller.php';

		$extendsBase  = "<?php\n\n";
		$extendsBase .= "namespace ".$mine."\Controllers;\n\n";
		$extendsBase .= "use Rhodium\BaseController;\n\n";
		$extendsBase .= "class ".$name." extends BaseController\n";
		$extendsBase .= "{\n";
		$extendsBase .= "public function __construct()\n";
		$extendsBase .= "{\n";
		$extendsBase .= "parent::__construct();\n";
		$extendsBase .= "}\n";
		$extendsBase .= "}";

		$standard  = "<?php\n\n";
		$standard .= "namespace ".$mine."\Controllers;\n\n";
		$standard .= "class ".$name."\n";
		$standard .= "{\n";
		$standard .= "}";		

		if ( $base == 'y' || $base == 'yes' ) {
			$handle = fopen( $file, 'w' ) or die('Cannot open file: ' . $file );
			fwrite( $handle, $extendsBase );
		} else {
			$handle = fopen( $file, 'w' ) or die('Cannot open file: ' . $file );
			fwrite( $handle, $standard );
		}
	}
}
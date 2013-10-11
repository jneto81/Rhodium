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
			->setName( 'Rhodium:Create:Model' )
			->setDescription( 'Creates a model.' )
			->addArgument( 'class', null, InputOption::VALUE_REQUIRED, 'Enter a class name.' )
			->addOption( 'base', null, InputOption::VALUE_OPTIONAL, 'Does this extend the base model?');
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$base = $input->getOption( 'base' );
		$class = $input->getArgument( 'class' );
		$class = explode( ':', $class );

		$mine = $class[0];
		$name = $class[1];

		

	}
}
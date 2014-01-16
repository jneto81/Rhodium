<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium\Database\DBCore as Database;

class CreateTable extends Command
{

	protected function configure()
	{
		$this	
			->setName( 'r:c:t' )
			->setDescription( 'Creates a controller.' )
			->addArgument( 'tableName', null, InputOption::VALUE_REQUIRED, 'Enter a table name.' )
			->addArgument(
			    'cols',
			    InputArgument::IS_ARRAY,
			    'Specify your columns.'
			);
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$tableName = $input->getArgument( 'tableName' );
		$columns   = $input->getArgument( 'cols' );

		$db = new Database();

		//CREATE TABLE pet (name VARCHAR(20), owner VARCHAR(20),
    	// -> species VARCHAR(20), sex CHAR(1), birth DATE, death DATE);

		echo $tableName . "\n";
		
		$sql  = 'CREATE TABLE ' . $tableName . " ";
		$sql .= '(';
		$sql .= "id int NOT NULL AUTO_INCREMENT, ";
		foreach ( $columns as $column ) {
			
			$col = explode( ':' , $column );
			
			$sql .= $col[0] . " ";
			
			if ( isset( $col[2] ) ) {
				$sql .= $col[1];
				$sql .= "(".$col[2]."), ";
			} else {
				$sql .= $col[1];
				$sql .= "(11), ";
			}
		}
		$sql .= "PRIMARY KEY (id)";
		$sql .= ')';

		$save = $db->prepare( $sql );

		if ( $save->execute() ) {
			$output->writeln('<info>Success!</info>');
		} else {
			$output->writeln('<error>Query failed.</error>');
		}
	}
}
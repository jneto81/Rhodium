<?php 

namespace Rhodium\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Rhodium;

class FetchBundle extends Command
{
	protected function configure()
	{
		$this
			->setName( 'Rhodium:Fetch:Bundle' )
			->setDescription( 'Creates a model.' )
			->addArgument( 'bundle', null, InputOption::VALUE_REQUIRED, 'Enter a bundle name.' );
	}

	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$zip = new \ZipArchive;

		$bundle = $input->getArgument( 'bundle' );

		$url = 'https://github.com/Rhodium-Digital/'.$bundle.'/archive/master.zip';
		$fh = fopen('master.zip', 'w');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_FILE, $fh); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // this will follow redirects
		curl_exec($ch);
		curl_close($ch);
		fclose($fh);

		$zip->open( 'master.zip' );
		$zip->extractTo( 'src/' );
		$zip->close();

		rename( 'src/' . $bundle . '-master', 'src/' . $bundle );

		unset( 'master.zip' );
	}
}
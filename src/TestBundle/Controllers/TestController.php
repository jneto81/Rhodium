<?php 

namespace TestBundle\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Rhodium\Controllers\BaseController;

class TestController extends BaseController
{
	public function indexAction( Request $request, $year )
	{
		$twig = $this->view( 'twig' )->render('Hello {{ test }}!', array( 'test' => 'Fuckers' ));
		//$twig = 'test';
		return new Response( $twig );
	}
}
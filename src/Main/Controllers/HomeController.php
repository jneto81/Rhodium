<?php 

namespace Main\Controllers;

use Rhodium\BaseController;

/**
 * HomeController
 *
 * This is a basic controller in Rhodium.
 *
 * We call a BaseController in this instance,
 * which allows us to call some base functions.
 * Such as loading models and views.
 */
class HomeController extends BaseController
{
	/**
	 * __construct
	 *
	 * If you're using the BaseController
	 * you will need it to extend the 
	 * constructor in order to use all
	 * of the functions in the BaseController.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->model( 'Main:Test' );
	}

	public function ourPage()
	{
		$test = $this->model->test();

		return $this->view( 'Main:index' );
	}

	public function adminHome()
	{
		return $this->view( 'Main:admin' );
	}

	public function formTest()
	{
		$data = array (
			'name' 	=> 'Your name',
			'email'	=> 'Your e-mail'
		);

		$form = self::$app['form.factory']->createBuilder( 'form', $data )
			->add( 'name' )
			->add( 'email' )
			->add( 'department', 'choice', array (
				'choices'  => array ( 1=> 'Marketing', 2 => 'Finance' ),
				'expanded' => true,
			))->getForm();

		return $this->view( 'Main:form', array ( 'form' => $form->createView() ) );
	}
}
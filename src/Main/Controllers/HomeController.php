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
	}

	public function ourPage()
	{
		$params = array('param1' => 'Ayup, ', 'param2' => ' world!');
		
		$view = $this->view('Main:index', $params);
		
		return $view;
	}

	public function form()
	{
		$form = new \Rhodium\Helpers\FormHelper();

		// $collection[] = $form->input(
		// 	array(
		// 		'type'			=> 'password',
		// 		'class' 		=> 'test-class',
		// 		'id'			=> 'test-id',
		// 		'name'			=> 'test-name',
		// 		'placeholder' 	=> 'test-placeholder',
		// 		'required'		=> 'required'
		// 		)
		// 	);

		// $collection[] = $form->input(
		// 	array(
		// 		'type'			=> 'file',
		// 		'class' 		=> 'test-class form-control',
		// 		'id'			=> 'test-id2',
		// 		'name'			=> 'test-name',
		// 		'placeholder' 	=> 'test-file',
		// 		'required'		=> ''
		// 	)
		// );

		// $collection[] = $form->select(
		// 	array(
		// 		'class' 	=> 'form-control',
		// 		'id'		=> '',
		// 		'name'		=> 'some-select',
		// 		'options' 	=> array (
		// 			'value1' => 'Value 1',
		// 			'value2' => 'Value 2'
		// 		)
		// 	)
		// );

		// $formParams = array (
		// 	'action' => '/user/post',
		// 	'method' => 'post',
		// 	'class'	 => 'form-class',
		// 	'id'	 => 'form-id'
		// );

		// $form = $form->create( $formParams, $collection );
		$form = $form->load( 'contact' );

		$view = $this->view( 'Main:form', array( 'form' => $form ) );

		return $view;
	}

	public function jsonForm()
	{

	}
}
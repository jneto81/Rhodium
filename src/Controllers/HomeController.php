<?php 

namespace YourAppName\Controllers;

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

	public function getData()
	{
		$model = $this->model('Test');

		$data = $model->getData();

		return $data;
	}

	public function ourPage()
	{
		$params = array('param1' => 'Hello, ', 'param2' => 'Rhodium user!');

		$view = $this->view('index', $params);

		return $view;
	}
}
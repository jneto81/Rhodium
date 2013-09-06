<?php 

namespace Bullion\Controllers;

use Rhodium\BaseController;

class AdminController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAdminControlPanel()
	{
		$model = $this->model('Bullion:Statistics');

		$data = $model->recentSales();

		$view = $this->view('Bullion:admin_home', $data);

		return $view;		
	}
}
<?php 

namespace IGIG\Controllers;

use Rhodium\BaseController;

class ShopController extends BaseController
{
	public function getView()
	{
		$view = $this->view('shop');

		return $view;
	}
}
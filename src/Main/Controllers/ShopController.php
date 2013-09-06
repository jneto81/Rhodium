<?php 

namespace Main\Controllers;

use Rhodium\BaseController;

class ShopController extends BaseController
{
	public function getView()
	{
		$view = $this->view('Main:shop');

		return $view;
	}
}
<?php 

namespace Bullion\Controllers;

use Bullion\Models\BasketModel;

class BasketController
{
	public function __construct()
	{
		$this->model = new BasketModel;
	}

	public function storeBasket()
	{
		$this->model->setTotal(23.00);
		$this->model->setCurrency('GBP');
		$this->model->setProducts(array('1' => 'Product 1', '2' => 'Product 2'));
		$this->model->persist( $this->model );
	}
}
<?php 

namespace Bullion\Controllers;

use Bullion\Models\BasketModel;
use Rhodium\BaseModel;

class BasketController
{
	public function __construct()
	{
		$this->model = new BasketModel;
		$this->basem = new BaseModel;
	}

	public function storeBasket( array $basket )
	{		
		$this->model->setTotal( $basket['total'] );
		$this->model->setCurrency( $basket['currency'] );
		$this->model->setProducts( $basket['products'] );

		d( $this->model );
		
		$this->basem->persist( $this->model );

		return 'Well...';
	}
}
<?php 

namespace Bullion\Models;

use Bullion\Models\BasketInterface;
use Rhodium\BaseModel;

class BasketModel extends BaseModel implements BasketInterface
{
	protected $total;
	protected $products;
	protected $currency;

	public function setTotal( $total )
	{
		$this->total = $total;

		return $this;
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function setProducts( array $products )
	{
		$this->products = $products;

		return $this;
	}

	public function getProducts()
	{
		return $this->products;
	}

	public function setCurrency( $currency )
	{
		$this->currency = $currency;

		return $this;
	}

	public function getCurrency()
	{
		return $this->currency;
	}
}
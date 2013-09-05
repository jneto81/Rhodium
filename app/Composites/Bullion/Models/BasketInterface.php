<?php

namespace Bullion\Models;

interface BasketInterface
{
	public function setTotal( $total );
	public function getTotal();
	public function setProducts( array $products );
	public function getProducts();
	public function setCurrency( $currency );
	public function getCurrency();
}
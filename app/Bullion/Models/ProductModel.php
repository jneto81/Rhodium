<?php 

namespace Bullion\Models;

class ProductModel implements ProductInterface
{

	protected $name;
	protected (array) $type;
	protected (array) $tags;
	protected (float) $price;
	protected (float) $salePrice;
	protected $fromDate;
	protected $toDate;
	protected (array) $vars;
	protected $country;
	protected (float) $weight;
	protected (array) $dimensions;

	public function setProductName( $name )
	{
		$this->name = $name;

		return $this;
	}

	public function getProductName()
	{
		return $this->name;
	}

	public function setProductType( array $type )
	{
		$this->type = $type;

		return $this;
	}

	public function getProductType()
	{
		return $this->type;
	}

	public function setProductTags( array $tags )
	{
		$this->tags = $tags;

		return $this;
	}

	public function getProductTags()
	{
		return $this->tags;
	}

	public function setProductPrice( int $price )
	{		
		$this->price = $price;

		return $this;		
	}	

	public function getProductPrice()
	{
		return $this->price;
	}

	public function setProductSalePrice( int $salePrice )
	{
		$this->salePrice = $salePrice;

		return $this;
	}

	public function getProductSalePrice()
	{
		return $this->salePrice;
	}

	public function setProductSaleStartDate( \Datetime $fromDate )
	{
		$this->fromDate = $fromDate;

		return $this;
	}

	public function getProductSaleStartDate()
	{
		return $this->fromDate;
	}

	public function setProductSaleEndDate( \Datetime $toDate )
	{
		$this->toDate = $toDate;

		return $this;
	}

	public function getProductSaleEndDate()
	{
		return $this->toDate;
	}

	public function setProductVars( array $vars )
	{
		$this->vars = $vars;

		return $this;
	}

	public function getProductVars()
	{
		return $this->vars;
	}

	public function setProductCountryOrigin( $country )
	{
		$this->country = $country;

		return $this;
	}

	public function getProductCountryOrigin()
	{
		return $this->country;
	}

	public function setProductWeight( int $weight )
	{	
		$this->weight = $weight;

		return $this;
	}

	public function getProductWeight()
	{
		return $this->weight;
	}

	public function setProductDimensions( array $dimensions )
	{
		$this->dimensions = $dimensions;

		return $this;
	}

	public function getProductDimensions()
	{
		return $this->dimensions;
	}
}
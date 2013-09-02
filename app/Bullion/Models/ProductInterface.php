<?php 

namespace Bullion\Models;

class ProductInterface
{
	public function setProductName( $name );
	public function getProductName();
	public function setProductType( array $type );
	public function getProductType();
	public function setProductTags( array $tags );
	public function getProductTags();
	public function setProductPrice( int $price );
	public function getProductPrice();
	public function setProductSalePrice( int $price );
	public function getProductSalePrice();
	public function setProductSaleStartDate( \Datetime $startDate );
	public function getProductSaleStartDate();
	public function setProductSalesEndDate( \Datetime $endDate );
	public function getProductSalesEndDate();
	public function setProductVars( array $vars );
	public function getProductVars();
	public function setProductCountryOrigin( $country );
	public function getProductCountryOrigin();
	public function setProductWeight( int $weight );
	public function getProductWeight();
	public function setProductDimensions( array $dimensions );
	public function getProductDimensions();
}
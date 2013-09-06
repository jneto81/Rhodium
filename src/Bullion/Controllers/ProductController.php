<?php 

namespace Bullion\Controllers;

use Rhodium\BaseController;
use Bullion\Models\ProductModel;

class ProductController extends BaseController
{
	public function __construct()
	{ 
		parent::__construct();
		$this->model = new ProductModel;
	}

	public function addProduct( array $product )
	{
		// 'tablename', 'data'
		$product = $this->model->persist( 'products', $product );

		if ( $product == true ) {
			return 'Product added successfully!';
		}

		return false;
	}

	public function getProduct( $id )
	{
		// 'tablename:column_name', 'search term'
		$product = $this->model->fetch( 'products:id', $id );

		$view = $this->view( 'Bullion:product_page', $product );

		if ( $view == true ) {
			return $view;
		}

		return false;
	}

	public function deleteProduct( $id )
	{

		$product = $this->model->deleteProduct( $id );

		if ( $product == true ) {
			return true;
		}

		return false;

	}

	public function updateProduct()
	{
		$product = $this->model->updateProduct( $id, $product );

		if ( $product == true ) {
			return true;
		}

		return false;
	}
}
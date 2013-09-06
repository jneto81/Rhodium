<?php 

use Rhodium\BaseController;
use Bullion\ProductModel;

class ProductController extends BaseController
{
	public function __construct()
	{ 
		$this->model = new ProductModel;
	}

	public function addProduct( ProductModel $product )
	{

		/** Needs to load view, but default twig rendering
		 * looks for stuff in src/Views, which ain't ideal
		 * for third party shit like this... 
		 **/
		$product = $this->model->persist( $product );

		if ( $product == true ) {
			return $product;
		}

		return false;
	}

	public function getProduct( $id )
	{
		$product = $this->model->getProductById( $id );

		if ( $product == true ) {
			return $product;
		}

		return false;
	}

	public function deleteProduct()
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
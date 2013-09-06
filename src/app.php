<?php 


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/** Homepage */
$app->match('/', function() use ( $app ) {

	/** 
	 * Load the controller to match the URL to.
	 * I'm also passing in the global app variable
	 * which will allow us to access some of the 
	 * global functions that come with Silex.
	 **/
	$controller = new Main\Controllers\HomeController( $app );	
	$content = $controller->ourPage();

	return new Response ( $content );
});

/** Shop front **/
$app->match('/shop', function() use ( $app ) {

	$controller = new Main\Controllers\ShopController();
	$content = $controller->getView();

	return new Response( $content );
});

/** Checkout */
$app->post('/checkout', function ( Request $request ) use ( $app ) {
	
	$basket = array(
		'total' 	=> $request->get('total'),
		'currency'	=> $request->get('currency'),
		'products'  => array( $request->get('products') )
	);

	$controller = new \Bullion\Controllers\BasketController();
	$content = $controller->storeBasket( $basket );

	return new Response( $content );

});

/** Admin */
$app->match('/admin', function() use ( $app ) {

	$controller = new Bullion\Controllers\AdminController();
	$content = $controller->getAdminControlPanel();

	return new Response ( $content );
});

/** Admin/Products */
$app->post('/admin/products/add', function( Request $request ) use ( $app ) {

	$product = array( 
		'name' => $request->get('name'),
		'type' => $request->get('type'),
		'tags' => $request->get('tags'),
		'price' => $request->get('price'),
		'startDate' => $request->get('startDate'),
		'endDate' => $request->get('endDate'),
		'vars' => $request->get('vars'),
		'country' => $request->get('country'),
		'weight' => $request->get('weight'),
		'dimensions' => $request->get('dimensions')
	);

	$controller = new \Bullion\Controllers\ProductController();
	$content = $controller->addProduct( $product );

	/** Callback from controller */
	return new Response ( $content );

});

$app->match('/admin/products/delete/{id}', function( $id ) use ( $app ) {

	$controller = new \Bullion\Controllers\ProductController();
	$content = $controller->deleteProduct( $id );

	return new Response ( $content );
});

$app->post('/admin/products/update/{id}', function( Request $request, $id ) use ( $app ) {

	$product = array( 
		'name' => $request->get('name'),
		'type' => $request->get('type'),
		'tags' => $request->get('tags'),
		'price' => $request->get('price'),
		'startDate' => $request->get('startDate'),
		'endDate' => $request->get('endDate'),
		'vars' => $request->get('vars'),
		'country' => $request->get('country'),
		'weight' => $request->get('weight'),
		'dimensions' => $request->get('dimensions')
	);

	$controller = new \Bullion\Controllers\ProductController();
	$content = $controller->updateProduct( $id, $product );

	return new Response ( $content );
});

$app->match('/admin/products/view/{id}', function( Request $request ) use ( $app ) {

	$controller = new \Bullion\Controllers\ProductController();
	$content = $controller->viewProductAdmin( $id );

	return new Response ( $content );

});

/** Admin/Categories */
$app->post('/admin/categories/add', function( Request $request ) use ( $app ) {

	$category = array ( 
		'name' => $request->get('name'),
		'description' => $request->get('description'),
		'parent' => $request->get('parent')
	);

	$controller = new \Bullion\Controllers\CategoryController();
	$content = $controller->addCategory( $category );

	return new Response ( $content );
});
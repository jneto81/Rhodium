<?php 

namespace ToDo\Controllers;

use Rhodium\BaseController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class AddItemController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->model( 'ToDo:AddItem' );
	}

	public function addItemView()
	{
		return $this->view( 'ToDo:add_item' );
	}

	public function addItem( Request $request )
	{
		$item = array (
			'title' 		=> $request->get( 'title' ),
			'description'	=> $request->get( 'description' ),
			'due'			=> $request->get( 'due' ),
			'is_done'		=> $request->get( 'is_done' )
		);

		$add = $this->model->add( $item );		

		return new Response ( 'Done.' );
	}
}
<?php 

namespace ToDo\Controllers;

use Rhodium\BaseController;

class GetItemController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->model( 'ToDo:GetItem' );
	}
}
<?php 

namespace ToDo\Models;

use Rhodium\BaseModel;

class AddItemModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add( $item )
	{
		$add = Item::create( $item );

		if ( $add ) {
			return true;
		} else {
			return false;
		}
	}
}

class Item extends \ActiveRecord\Model
{

}
<?php 

namespace Bullion\Models;

class WishListModel implements WishListInterface
{
	public function setWishList( array $wishList )
	{
		$this->wishList = $wishList;

		return $this;
	}

	public function getWishList()
	{
		return $this->wishList;
	}
}
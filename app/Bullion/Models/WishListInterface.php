<?php 

namespace Bullion\Models;

interface WishListInterface
{
	public function setWishListName( $name );
	public function getWishListName();
	public function setWishList( array $products );
	public function getWishList();
}
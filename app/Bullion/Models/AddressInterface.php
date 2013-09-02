<?php 

namespace Bullion\Models;

interface AddressInterface
{
	public function setAddressHouseName( $name );
	public function getAddressHouseName();
	public function setAddressHouseNumber( $number );
	public function getAddressHouseNumber();
	public function setAddressLineOne( $lineOne );
	public function getAddressLineOne();
	public function setAddressLineTwo( $lineTwo );
	public function getAddressLineTwo();
	public function setAddressPostCode( $postCode );
	public function getAddressPostCode();
	public function setAddressName( $addressName );
	public function getAddressName();
}
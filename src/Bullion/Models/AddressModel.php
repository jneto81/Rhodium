<?php 

namespace Bullion\Models;

class AddressModel implements AddressInterface
{

	protected $name;
	protected (int) $number;
	protected $lineOne;
	protected $lineTwo;
	protected $postCode;
	protected $addressName;

	public function setAddressHouseName( $name )
	{
		$this->name = $name;

		return $this;
	}

	public function getAddressHouseName()
	{
		return $this->name;
	}

	public function setAddressHouseNumber( int $number )
	{
		$this->number = $number;

		return $this;
	}

	public function getAddressHouseNumber()
	{	
		return $this->number;
	}

	public function setAddressLineOne( $lineOne )
	{
		$this->lineOne = $lineOne;

		return $this;
	}

	public function getAddressLineOne()
	{
		return $this->lineOne;
	}

	public function setAddressLineTwo( $lineTwo )
	{
		$this->lineTwo = $lineTwo;

		return $this;
	}

	public function getAddressLineTwo()
	{
		return $this->lineTwo;
	}

	public function setAddressPostCode( $postCode )
	{
		$this->postCode = $postCode;

		return $this;
	}

	public function getAddressPostCode()
	{
		return $this->postCode;
	}

	public function setAddressName( $addressName )
	{
		$this->addressName = $addressName;

		return $this;
	}	

	public function getAddressName()
	{
		return $this->addressName;
	}
}
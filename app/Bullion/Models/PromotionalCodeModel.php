<?php 

namespace Bullion\Models;

class PromotionalCodeModel extends PromotionalCodeInterface
{

	protected $code;
	protected (bool) $isValid;
	protected $fromDate;
	protected $toDate;
	protected (float) $amount;

	public function setPromoCode( $code )
	{
		$this->code = $code;

		return $this;
	}

	public function getPromoCode()
	{
		return $this->code;
	}

	public function setPromoCodeValid( bool $isValid )
	{
		$this->isValid = $isValid;

		return $this;
	}

	public function getPromoCodeValid()
	{
		return $this->isValid;
	}

	public function setPromoCodeValidFromDate( \Datetime $fromDate )
	{
		$this->fromDate = $fromDate;

		return $this;
	}

	public function getPromoCodeValidFromDate()
	{
		return $this->fromDate;
	}

	public function setPromoCodeValidToDate( \Datetime $toDate )
	{
		$this->toDate = $toDate;

		return $this;
	}

	public function getPromoCodeValidToDate()
	{
		return $this->toDate;
	}

	public function setPromoCodeSubtractAmount( float $amount )
	{
		$this->amount = $amount;

		return $this;
	}

	public function getPromoCodeSubtractAmount()
	{
		return $this->amount;
	}
}
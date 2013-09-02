<?php 

namespace Bullion\Models;

interface PromotionalCodeInterface
{
	public function setPromoCode( $code );
	public function getPromoCode();
	public function setPromoCodeValid( bool $isValid );
	public function getPromoCodeValid();
	public function setPromoValidFromDate( \Datetime $fromDate );
	public function getPromoValidFromDate();
	public function setPromoValidToDate( \Datetime $toDate );
	public function getPromoValidToDate();
	public function setPromoCodeSubtractAmount( float $amount );
	public function getPromoCodeSubtractAount();
}
<?php 

namespace Bullion\Models;

use Rhodium\BaseModel;

class StatisticsModel extends BaseModel
{
	public function __construct( $params )
	{
		parent::__construct();
		$this->params = $params;
	}

	public function recentSales()
	{
		$data = array(
			'totalSales' => '51',
			'totalValue' => '850.23'
		);

		return $data;
	}
}
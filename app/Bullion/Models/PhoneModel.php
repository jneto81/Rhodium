<?php 

namespace Bullion\Models;

class PhoneModel implements PhoneInterface
{

	protected (int) $homePhone;
	protected (int) $workPhone;

	public function setHomePhone( int $homePhone )
	{
		$this->homePhone = $homePhone;

		return $this;
	}

	public function getHomePhone()
	{
		return $this->homePhone;
	}

	public function setWorkPhone( int $workPhone )
	{
		$this->workPhone = $workPhone;

		return $this;
	}

	public function getWorkPhone()
	{
		return $this->workPhone;
	}
}
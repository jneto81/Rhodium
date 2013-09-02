<?php

namespace Bullion\Models;

interface PhoneInterface
{
	public function setHomePhone( int $homePhone );
	public function getHomePhone();
	public function setWorkPhone( int $workPhone );
	public function getWorkPhone();
}
<?php

class ResourceService extends Service
{

	public function getCountries()
	{
		return $this->beans->resourceModel->getCountries();
	}

	public function getStates($countryCode, $fieldList = "*")
	{
		return $this->beans->resourceModel->getStates($countryCode, $fieldList);
	}
}
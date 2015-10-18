<?php

class ResourceService extends Service
{

	public function getCountries()
	{
		return $this->model->getCountries();
	}

	public function getStates($countryCode, $fieldList = "*")
	{
		return $this->model->getStates($countryCode, $fieldList);
	}

}
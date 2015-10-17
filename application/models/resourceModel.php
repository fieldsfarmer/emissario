<?php

class ResourceModel extends Model
{

	public function getCountries()
	{
		$sql = "SELECT *
				FROM Country";

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getStates($countryCode)
	{
		$sql = "SELECT *
				FROM State
				WHERE Country_Code = :country_code";

		$parameters = array(":country_code" => $countryCode);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

}

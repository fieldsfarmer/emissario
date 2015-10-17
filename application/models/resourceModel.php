<?php

class ResourceModel extends Model
{

	public function getCountries()
	{
		$sql = "SELECT *
				FROM Country
				ORDER BY CASE WHEN Country_Code = 'US' THEN 1 ELSE 2 END, Country_Name";

		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getStates($countryCode)
	{
		$sql = "SELECT *
				FROM State
				WHERE Country_Code = :country_code
				ORDER BY State_Code";

		$parameters = array(":country_code" => $countryCode);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

}

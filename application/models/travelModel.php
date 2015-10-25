<?php

class TravelModel extends Model
{

	public function getTravels($userID, $travelDateType = "", $search = "")
	{
		$sql = "SELECT Travel.*,
					DATE_FORMAT(Travel.Travel_Date, '%m/%d/%Y') AS Formatted_Travel_Date,
					Orig_Country.Country_Name AS Origin_Country_Name,
					Dest_Country.Country_Name AS Destination_Country_Name
				FROM Travel
				LEFT JOIN Country Orig_Country ON Orig_Country.Country_Code = Travel.Origin_Country
				LEFT JOIN Country Dest_Country ON Dest_Country.Country_Code = Travel.Destination_Country
				WHERE Travel.User_ID = :user_id";

		if (strcasecmp($travelDateType, "future") == 0)
		{
			$sql .= " AND Travel.Travel_Date > DATE(NOW())";
		}
		else if (strcasecmp($travelDateType, "past") == 0)
		{
			$sql .= " AND Travel.Travel_Date <= DATE(NOW())";
		}

		if (trim($search) != "")
		{
			$sql .= " AND (Travel.Origin_City LIKE :search
						OR Orig_Country.Country_Name LIKE :search
						OR Travel.Destination_City LIKE :search
						OR Dest_Country.Country_Name LIKE :search)";
		}

		$sql .= " ORDER BY Travel.Travel_Date";

		$parameters = array(":user_id" => $userID);
		if (trim($search) != "")
		{
			$parameters[":search"] = "%" . trim($search) . "%";
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getTravel($travelID, $userID = "")
	{
		$sql = "SELECT Travel.*,
					DATE_FORMAT(Travel_Date, '%m/%d/%Y') AS Formatted_Travel_Date,
					Orig_Country.Country_Name AS Origin_Country_Name,
					Dest_Country.Country_Name AS Destination_Country_Name
				FROM Travel
				LEFT JOIN Country Orig_Country ON Orig_Country.Country_Code = Travel.Origin_Country
				LEFT JOIN Country Dest_Country ON Dest_Country.Country_Code = Travel.Destination_Country
				WHERE Travel.ID = :travel_id";
		if (is_numeric($userID)) {
			$sql .= " AND Travel.User_ID = :user_id";
		}

		$parameters = array(':travel_id' => $travelID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

	public function insertTravel() {
		$sql = "INSERT INTO Travel (User_ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, Created_On, Modified_On)
				VALUES (:user_id, :origin_city, :origin_country, :destination_city, :destination_country, STR_TO_DATE(:travel_date, '%m/%d/%Y'), NOW(), NOW())";

		$parameters = array(
				":user_id" => $_POST["userID"],
				":origin_city" => $_POST["originCity"],
				":origin_country" => $_POST["originCountry"],
				":destination_city" => $_POST["destinationCity"],
				":destination_country" => $_POST["destinationCountry"],
				":travel_date" => $_POST["travelDate"]
		);

		return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function updateTravel() {
		$sql = "UPDATE Travel
				SET Origin_City = :origin_city,
					Origin_Country = :origin_country,
					Destination_City = :destination_city,
					Destination_Country = :destination_country,
					Travel_Date = STR_TO_DATE(:travel_date, '%m/%d/%Y'),
					Modified_On = NOW()
				WHERE Travel.ID = :travel_id
					AND Travel.User_ID = :user_id";

		$parameters = array(
				":travel_id" => $_POST["travelID"],
				":user_id" => $_POST["userID"],
				":origin_city" => $_POST["originCity"],
				":origin_country" => $_POST["originCountry"],
				":destination_city" => $_POST["destinationCity"],
				":destination_country" => $_POST["destinationCountry"],
				":travel_date" => $_POST["travelDate"]
		);

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function deleteTravel($travelID, $userID) {
		$sql = "DELETE
				FROM Travel
				WHERE Travel.ID = :travel_id
					AND Travel.User_ID = :user_id";

		$parameters = array(
				":travel_id" => $travelID,
				":user_id" => $userID
		);

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

}

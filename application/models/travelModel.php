<?php

class TravelModel extends Model
{

	public function getTravels($userID)
	{
		$sql = "SELECT *, DATE_FORMAT(Travel_Date, '%m/%d/%Y') AS Formatted_Travel_Date
        		FROM Travel
        		WHERE Travel.User_ID = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(":user_id" => $userID);
		$query->execute($parameters);
	
		return $query->fetchAll();
	}
	
	public function getTravel($travelID, $userID = "")
	{
		$sql = "SELECT *, DATE_FORMAT(Travel_Date, '%m/%d/%Y') AS Formatted_Travel_Date
        		FROM Travel
        		WHERE Travel.ID = :travel_id";
		if (is_numeric($userID)) {
			$sql .= " AND Travel.User_ID = :user_id";
		}
	
		$query = $this->db->prepare($sql);
	
		$parameters = array(':travel_id' => $travelID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}
	
		$query->execute($parameters);
	
		return $GLOBALS["helpers"]->queryHelper->getSingleRowObject($query);
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
	
		return $GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
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

		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
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
	
		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}
}

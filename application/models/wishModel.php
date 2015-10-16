<?php

class WishModel extends Model
{

	public function getWishes($userID)
	{
		$sql = "SELECT *
        		FROM Wish
        		WHERE Wish.User_ID = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(":user_id" => $userID);
		$query->execute($parameters);
	
		return $query->fetchAll();
	}

	public function getWish($wishID, $userID = "")
	{
		$sql = "SELECT *
        		FROM Wish
        		WHERE Wish.ID = :wish_id";
		if (is_numeric($userID)) {
			$sql .= " AND Wish.User_ID = :user_id";
		}

		$query = $this->db->prepare($sql);

		$parameters = array(':wish_id' => $wishID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}

		$query->execute($parameters);
	
		return $GLOBALS["helpers"]->queryHelper->getSingleRowObject($query);
	}
	
	public function insertWish() {
		$sql = "INSERT INTO Wish (User_ID, Description, Weight, Destination_City, Destination_Country, Max_Date, Compensation, Created_On, Modified_On)
				VALUES (:user_id, :description, :weight, :destination_city, :destination_country, :max_date, :compensation, NOW(), NOW())";
	
		$parameters = array(
				":user_id" => $_POST["userID"],
				":description" => $_POST["description"],
				":weight" => $_POST["weight"],
				":destination_city" => $_POST["destinationCity"],
				":destination_country" => $_POST["destinationCountry"],
				":max_date" => $_POST["maxDate"],
				":compensation" => $_POST["compensation"]
			);
	
		return $GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function updateWish() {
		$sql = "UPDATE Wish
				SET Description = :description,
					Weight = :weight,
					Destination_City = :destination_city,
					Destination_Country = :destination_country,
					Max_Date = :max_date,
					Compensation = :compensation,
					Modified_On = NOW()
				WHERE Wish.ID = :wish_id
					AND Wish.User_ID = :user_id";
	
		$parameters = array(
				":wish_id" => $_POST["wishID"],
				":user_id" => $_POST["userID"],
				":description" => $_POST["description"],
				":weight" => $_POST["weight"],
				":destination_city" => $_POST["destinationCity"],
				":destination_country" => $_POST["destinationCountry"],
				":max_date" => $_POST["maxDate"],
				":compensation" => $_POST["compensation"]
			);
	
		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function deleteWish($wishID, $userID) {
		$sql = "DELETE
				FROM Wish
				WHERE Wish.ID = :wish_id
					AND Wish.User_ID = :user_id";
		
		$parameters = array(
				":wish_id" => $wishID,
				":user_id" => $userID
			);
		
		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);		
	}
}

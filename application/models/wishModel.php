<?php

class WishModel extends Model
{

	public function getWishes($userID, $search = "")
	{
		$sql = "SELECT Wish.*,
					DATE_FORMAT(Wish.Max_Date, '%m/%d/%Y') AS Formatted_Max_Date,
					Country.Country_Name AS Destination_Country_Name
				FROM Wish
				LEFT JOIN Country ON Country.Country_Code = Wish.Destination_Country
				WHERE Wish.User_ID = :user_id";

		if (trim($search) != "")
		{
			$sql .= " AND (Wish.Description LIKE :search
						OR Wish.Destination_City LIKE :search
						OR Country.Country_Name LIKE :search)";
		}
		
		$sql .= " ORDER BY Wish.Created_On";

		$parameters = array(":user_id" => $userID);
		if (trim($search) != "")
		{
			$parameters[":search"] = "%" . trim($search) . "%";
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getWish($wishID, $userID = "")
	{
		$sql = "SELECT Wish.*,
					DATE_FORMAT(Wish.Max_Date, '%m/%d/%Y') AS Formatted_Max_Date,
					Country.Country_Name AS Destination_Country_Name
				FROM Wish
				LEFT JOIN Country ON Country.Country_Code = Wish.Destination_Country
				WHERE Wish.ID = :wish_id";
		if (is_numeric($userID)) {
			$sql .= " AND Wish.User_ID = :user_id";
		}

		$parameters = array(':wish_id' => $wishID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

	public function insertWish() {
		$sql = "INSERT INTO Wish (User_ID, Description, Weight, Destination_City, Destination_Country, Max_Date, Compensation, Created_On, Modified_On)
				VALUES (:user_id, :description, :weight, :destination_city, :destination_country, STR_TO_DATE(:max_date, '%m/%d/%Y'), :compensation, NOW(), NOW())";

		$parameters = array(
				":user_id" => $_POST["userID"],
				":description" => $_POST["description"],
				":weight" => $_POST["weight"],
				":destination_city" => $_POST["destinationCity"],
				":destination_country" => $_POST["destinationCountry"],
				":max_date" => $_POST["maxDate"],
				":compensation" => $_POST["compensation"]
			);

		return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function updateWish() {
		$sql = "UPDATE Wish
				SET Description = :description,
					Weight = :weight,
					Destination_City = :destination_city,
					Destination_Country = :destination_country,
					Max_Date = STR_TO_DATE(:max_date, '%m/%d/%Y'),
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

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
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

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

}

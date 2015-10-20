<?php

class HelpModel extends Model
{
	public function getWishes($userID)
	{
		$sql = "SELECT Wish.*,
					DATE_FORMAT(Wish.Max_Date, '%m/%d/%Y') AS Formatted_Max_Date,
					Country.Country_Name AS Destination_Country_Name
				FROM Wish
				LEFT JOIN Country ON Country.Country_Code = Wish.Destination_Country
				WHERE Wish.User_ID <> :user_id";

		$parameters = array(":user_id" => $userID);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}
}

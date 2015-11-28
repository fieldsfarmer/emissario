<?php

class HelpModel extends Model
{

	public function getHelpsForWish($wishID, $wishOwnerID = "")
	{
		$sql = "SELECT Help.*,
					User.First_Name AS Helper_First_Name,
					User.Last_Name AS Helper_Last_Name
				FROM Help
				INNER JOIN Wish ON Wish.ID = Help.Wish_ID
				INNER JOIN User ON User.ID = Help.User_ID
				WHERE Help.Wish_ID = :wish_id";

		if (is_numeric($wishOwnerID)) {
			$sql .= " AND Wish.User_ID = :wish_owner_id";
		}

		$sql .= " ORDER BY Help.Requested DESC, Help.Offered DESC";

		$parameters = array(":wish_id" => $wishID);
		if (is_numeric($wishOwnerID))
		{
			$parameters[":wish_owner_id"] = $wishOwnerID;
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getHelpsForOthers($userID, $wishStatus = "", $helpStatus = "", $search = "")
	{
		$sql = "SELECT Help.*,
					Wish.Description AS Wish_Description,
					Wish.Destination_City AS Wish_Destination_City,
					Wish.Status AS Wish_Status,
					Country.Country_Name AS Wish_Destination_Country_Name,
					Owner.First_Name AS Wish_Owner_First_Name,
					Owner.Last_Name AS Wish_Owner_Last_Name
				FROM Help
				INNER JOIN Wish ON Wish.ID = Help.Wish_ID
				INNER JOIN User Owner ON Owner.ID = Wish.User_ID
				LEFT JOIN Country ON Country.Country_Code = Wish.Destination_Country
				WHERE Help.User_ID = :user_id";

		if (strcasecmp($wishStatus, "closed") == 0)
		{
			$sql .= " AND Wish.Status = 'Closed'";
		}
		else if (strcasecmp($wishStatus, "not_closed") == 0)
		{
			$sql .= " AND Wish.Status IN ('Open', 'Accepted')";
		}

		if (strcasecmp($helpStatus, "accepted") == 0)
		{
			$sql .= " AND Help.Requested = 1
					AND Help.Offered = 1";
		}
		else if (strcasecmp($helpStatus, "offered") == 0)
		{
			$sql .= " AND Help.Requested = 0
					AND Help.Offered = 1";
		}
		else if (strcasecmp($helpStatus, "requested") == 0)
		{
			$sql .= " AND Help.Requested = 1
					AND Help.Offered = 0";
		}

		if (trim($search) != "")
		{
			$sql .= " AND (Wish.Description LIKE :search
						OR Wish.Destination_City LIKE :search
						OR Country.Country_Name LIKE :search
						OR CONCAT(Owner.First_Name, ' ', Owner.Last_Name) LIKE :search)";
		}

		$sql .= " ORDER BY Help.Offered DESC, Help.Requested DESC";

		$parameters = array(":user_id" => $userID);
		if (trim($search) != "")
		{
			$parameters[":search"] = "%" . trim($search) . "%";
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getHelp($helpID, $userID = "")
	{
		$sql = "SELECT Help.*,
					Wish.Description AS Wish_Description,
					Wish.Destination_City AS Wish_Destination_City,
					Wish.Status AS Wish_Status,
					Wish.Weight AS Wish_Weight,
					Wish.Compensation AS Wish_Compensation,
					DATE_FORMAT(Wish.Max_Date, '%m/%d/%Y') AS Wish_Max_Date,
					Country.Country_Name AS Wish_Destination_Country_Name,
					Owner.ID AS Wish_Owner_ID,
					Owner.First_Name AS Wish_Owner_First_Name,
					Owner.Last_Name AS Wish_Owner_Last_Name,
					Review.Recommended AS Review_Recommended,
					Review.Comments AS Review_Comments
				FROM Help
				INNER JOIN Wish ON Wish.ID = Help.Wish_ID
				INNER JOIN User Owner ON Owner.ID = Wish.User_ID
				LEFT JOIN Country ON Country.Country_Code = Wish.Destination_Country
				LEFT JOIN Review ON Review.Help_ID = Help.ID
				WHERE Help.ID = :help_id";

		if (is_numeric($userID)) {
			$sql .= " AND Help.User_ID = :user_id";
		}

		$parameters = array(":help_id" => $helpID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

}

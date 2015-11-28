<?php

class HelpModel extends Model
{

	public function getHelpsForWish($wishID, $wishOwnerID = "")
	{
		$sql = "SELECT Help.*,
					User.First_Name AS Helper_First_Name, User.Last_Name AS Helper_Last_Name
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

}

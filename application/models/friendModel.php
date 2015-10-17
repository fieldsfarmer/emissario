<?php

class FriendModel extends Model
{

	public function getFriends($userID)
	{
		$sql = "SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID2
				WHERE Friend.User_ID1 = :user_id
					AND Friend.Pending = 0
				UNION
				SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID1
				WHERE Friend.User_ID2 = :user_id
					AND Friend.Pending = 0";

		$parameters = array(":user_id" => $userID);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

}

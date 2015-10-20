<?php

class FriendModel extends Model
{

	public function getFriends($userID)
	{
		$sql = "SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country, User.ID, User.Email
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID2
				WHERE Friend.User_ID1 = :user_id
					AND Friend.Pending = 0
				UNION
				SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country, User.ID, User.Email
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID1
				WHERE Friend.User_ID2 = :user_id
					AND Friend.Pending = 0";

		$parameters = array(":user_id" => $userID);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getSingle($userID, $friendID)
	{
		$sql = "SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country, User.ID, User.Email, User.Phone, 
		Travel.Origin_City, Travel.Destination_City, Travel.Destination_Country, Travel.Origin_Country, Travel.Travel_Date
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID2
				INNER JOIN Travel ON Travel.User_ID= :friend_id
				WHERE Friend.User_ID1 = :user_id
					AND Friend.User_ID2 = :friend_id
					AND Friend.Pending = 0
				UNION
				SELECT User.First_Name, User.Last_Name, User.City, User.State, User.Country, User.ID, User.Email, User.Phone, 
		Travel.Origin_City, Travel.Destination_City, Travel.Destination_Country, Travel.Origin_Country, Travel.Travel_Date
				FROM Friend
				INNER JOIN User ON User.ID = Friend.User_ID1
				INNER JOIN Travel ON Travel.User_ID= :friend_id
				WHERE Friend.User_ID2 = :user_id
					AND Friend.User_ID1 = :friend_id
					AND Friend.Pending = 0";

		$parameters = array(":user_id" => $userID , ":friend_id"=> $friendID,);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}
}
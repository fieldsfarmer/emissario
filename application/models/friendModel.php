<?php

class FriendModel extends Model
{

	public function getFriends($userID, $friendType, $search = "")
	{
		$sql = "SELECT User.ID, User.First_Name, User.Last_Name, User.City, User.State, User.Country, F.Pending
				FROM (";

		if (strcasecmp($friendType, "pending_mine") == 0)
		{
			$sql .= " SELECT User_ID1 AS Friend_ID, Pending
					FROM Friend
					WHERE User_ID2 = :user_id
						AND Pending = 1";
		}
		else if (strcasecmp($friendType, "pending_friend") == 0)
		{
			$sql .= " SELECT User_ID2 AS Friend_ID, Pending
					FROM Friend
					WHERE User_ID1 = :user_id
						AND Pending = 1";
		}
		else
		{
			$sql .= " SELECT User_ID2 AS Friend_ID, Pending
					FROM Friend
					WHERE User_ID1 = :user_id
						AND Pending = 0
					UNION
					SELECT User_ID1 AS Friend_ID, Pending
					FROM Friend
					WHERE User_ID2 = :user_id
						AND Pending = 0";
		}

		$sql .= " ) F
				INNER JOIN User ON User.ID = F.Friend_ID";

		if (trim($search) != "")
		{
			$sql .= " WHERE (User.First_Name LIKE :search
						OR User.Last_Name LIKE :search
						OR User.Email LIKE :search)";
		}
		
		$sql .= " ORDER BY User.First_Name, User.Last_Name";

		$parameters = array(":user_id" => $userID);
		if (trim($search) != "")
		{
			$parameters[":search"] = "%" . trim($search) . "%";
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getFriend($friendID, $userID = "")
	{
		$sql = "SELECT User.ID, User.First_Name, User.Last_Name, User.City, User.State, User.Country, User.Email
				FROM User";

		if (is_numeric($userID))
		{
			$sql .= " INNER JOIN (
					SELECT User_ID2 AS Friend_ID
					FROM Friend
					WHERE User_ID1 = :user_id
						AND Pending = 0
					UNION
						SELECT User_ID1 AS Friend_ID
						FROM Friend
						WHERE User_ID2 = :user_id
							AND Pending = 0
				) F ON F.Friend_ID = User.ID";
		}

		$sql .= " WHERE User.ID = :friend_id";

		$parameters = array(':friend_id' => $friendID);
		if (is_numeric($userID))
		{
			$parameters[":user_id"] = $userID;
		}

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

	public function deleteFriend($friendID, $userID) {
		$sql = "DELETE
				FROM Friend
				WHERE (Friend.User_ID1 = :friend_id
						AND Friend.User_ID2 = :user_id)
					OR (Friend.User_ID2 = :friend_id
						AND Friend.user_ID1 = :user_id)";

		$parameters = array(
				":friend_id" => $friendID,
				":user_id" => $userID
		);

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function searchPotentialFriends($search, $userID)
	{
		$sql = "SELECT User.ID, User.First_Name, User.Last_Name, User.City, User.State, User.Country
				FROM User
				WHERE User.ID <> :user_id
					AND (CONCAT(First_Name, ' ', Last_Name) LIKE CONCAT('%', :search, '%')
						OR Email = :search)
					AND NOT EXISTS (
						SELECT Friend.User_ID2
						FROM Friend
						WHERE Friend.User_ID1 = :user_id
							AND Friend.User_ID2 = User.ID
					)
					AND NOT EXISTS (
						SELECT Friend.User_ID1
						FROM Friend
						WHERE Friend.User_ID2 = :user_id
							AND Friend.User_ID1 = User.ID
					)
				ORDER BY User.First_Name, User.Last_Name";
	
		$parameters = array(
				":user_id" => $userID,
				":search" => trim($search)
		);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function insertFriend($friendID) {
		$sql = "INSERT INTO friend (User_ID1, User_ID2, Pending, Created_On, Modified_On)
				VALUES (:user_id, :friend_id, 1, NOW(), NOW())";
	
		$parameters = array(
				":user_id" => $_POST["userID"],
				":friend_id" => $friendID
		);
	
		return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}
}
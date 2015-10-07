<?php

class UserModel extends Model
{

	public function getUser($user_id)
	{
		$sql = "SELECT User.*
        		FROM User
        		WHERE User.ID = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id);
		$query->execute($parameters);
	
		return $query->fetch();
	}

}

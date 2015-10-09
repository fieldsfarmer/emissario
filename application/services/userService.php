<?php

class UserService extends Service
{

	public function getUser($user_id)
	{
		return $this->beans["userModel"]->getUser($user_id);
	}
	
	public function saveUser()
	{
		if (is_numeric($_POST["userID"])) {
			$this->beans["userModel"]->updateUser();
		}
		else {
			$this->beans["userModel"]->insertUser();
		}
	}
	
}
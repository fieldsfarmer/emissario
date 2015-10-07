<?php

class UserService extends Service
{

	public function getUser($user_id)
	{
		return $this->beans["userModel"]->getUser($user_id);
	}
	
}
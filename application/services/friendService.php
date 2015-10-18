<?php

class FriendService extends Service
{

	public function getFriends($userID)
	{
		return $this->model->getFriends($userID);
	}

}
<?php

class FriendService extends Service
{

	public function getFriends($userID)
	{
		return $this->beans->friendModel->getFriends($userID);
	}
}
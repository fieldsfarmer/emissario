<?php

class FriendService extends Service
{

	public function getFriends($userID)
	{
		return $this->model->getFriends($userID);
	}

	public function getFriend($friendID, $userID = "")
	{
		return $this->model->getFriend($friendID, $userID);
	}

	public function deleteFriend($friendID, $userID)
	{
		$this->model->deleteFriend($friendID, $userID);
	}
}
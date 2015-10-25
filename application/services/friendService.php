<?php

class FriendService extends Service
{

	public function getFriends($userID, $friendType, $search = "")
	{
		return $this->model->getFriends($userID, $friendType, $search);
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
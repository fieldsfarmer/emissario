<?php

class FriendService extends Service
{

	public function getFriends($userID)
	{
		return $this->model->getFriends($userID);
	}
	public function getSingle($userID, $friendID)
	{
		return $this->model->getSingle($userID, $friendID);
	}

}
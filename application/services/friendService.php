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

	public function searchPotentialFriends($search, $userID)
	{
		return $this->model->searchPotentialFriends($search, $userID);
	}

	public function saveFriends()
	{
		foreach (explode(",", $_POST["friendIDs"]) as $friendID) {
			$this->model->insertFriend($friendID);
		}
	}

	public function acceptFriend($friendID, $userID)
	{
		$this->model->acceptFriend($friendID, $userID);
	}

}
<?php

class FriendService extends Service
{

	public function getFriends($user_id)
	{
		return $this->beans["friendModel"]->getFriends($user_id);
	}
}
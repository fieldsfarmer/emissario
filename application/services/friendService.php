<?php

class FriendService
{
	function __construct($beans)
	{
		$this->beans = $beans;
	}
	
	public function getFriends($user_id)
	{
		return $this->beans["friendModel"]->getFriends($user_id);
	}
}
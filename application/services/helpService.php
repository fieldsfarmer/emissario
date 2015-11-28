<?php

class HelpService extends Service
{

	public function getHelpsForWish($wishID, $wishOwnerID = "")
	{
		return $this->model->getHelpsForWish($wishID, $wishOwnerID);
	}

	public function getHelpsForOthers($userID, $helpStatus = "", $search = "")
	{
		return $this->model->getHelpsForOthers($userID, $helpStatus, $search);
	}

	public function getHelp($helpID, $userID = "")
	{
		return $this->model->getHelp($helpID, $userID);
	}

}
<?php

class WishService extends Service
{

	public function getWishes($userID)
	{
		return $this->beans->wishModel->getWishes($userID);
	}

	public function getWish($wishID, $userID = "")
	{
		return $this->beans->wishModel->getWish($wishID, $userID);
	}

	public function saveWish()
	{
		$wishID = $_POST["wishID"];

		if (is_numeric($wishID)) {
			$this->beans->wishModel->updateWish();
		}
		else {
			$wishID = $this->beans->wishModel->insertWish();
		}

		return $wishID;
	}
}
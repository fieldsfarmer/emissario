<?php

class WishService extends Service
{

	public function getWishes($userID, $search = "")
	{
		return $this->model->getWishes($userID, $search);
	}

	public function getWish($wishID, $userID = "")
	{
		return $this->model->getWish($wishID, $userID);
	}

	public function saveWish()
	{
		$wishID = $_POST["wishID"];

		if (is_numeric($wishID)) {
			$this->model->updateWish();
		}
		else {
			$wishID = $this->model->insertWish();
		}

		return $wishID;
	}

	public function deleteWish($wishID, $userID)
	{
		$this->model->deleteWish($wishID, $userID);
	}

}
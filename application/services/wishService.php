<?php

class WishService extends Service
{

	public function getWishes($userID, $wishStatus = "", $search = "")
	{
		return $this->model->getWishes($userID, $wishStatus, $search);
	}

	public function getWish($wishID, $userID = "", $wishStatus = "")
	{
		return $this->model->getWish($wishID, $userID, $wishStatus);
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

	public function updateWishStatus($wishID, $status, $userID = "")
	{
		$this->model->updateWishStatus($wishID, $status, $userID);
	}

}
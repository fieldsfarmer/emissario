<?php

class HelpService extends Service
{

	public function getHelpsForWish($wishID, $wishOwnerID = "")
	{
		return $this->model->getHelpsForWish($wishID, $wishOwnerID);
	}

}
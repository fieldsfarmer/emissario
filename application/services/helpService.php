<?php

class HelpService extends Service
{
	public function getWishes($userID)
	{
		return $this->model->getWishes($userID);
	}

	
}
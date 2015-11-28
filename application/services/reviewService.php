<?php

class ReviewService extends Service
{

	public function getReviews($userID, $reviewType, $recommended = "")
	{
		return $this->model->getReviews($userID, $reviewType, $recommended);
	}

}
<?php

class Reviews
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$reviewType = "received";
		if (array_key_exists("reviewType", $_POST))
		{
			$reviewType = $_POST["reviewType"];
		}

		$recommended = "";
		if (array_key_exists("recommended", $_POST))
		{
			$recommended = $_POST["recommended"];
		}

		$reviews = $GLOBALS["beans"]->reviewService->getReviews($userID, $reviewType, $recommended);

		require APP . 'views/_templates/header.php';
		require APP . 'views/reviews/index.php';
		require APP . 'views/_templates/footer.php';
	}

}
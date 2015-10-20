<?php

class Helps
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wishes = $GLOBALS["beans"]->helpService->getWishes($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/helps/index.php';
		require APP . 'views/_templates/footer.php';
	}

}
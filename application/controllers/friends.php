<?php

class Friends
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$friends = $GLOBALS["beans"]->friendService->getFriends($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/friends/index.php';
		require APP . 'views/_templates/footer.php';
	}

}

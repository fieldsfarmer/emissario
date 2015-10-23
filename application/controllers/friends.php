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

	public function view($friendID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$friend = $GLOBALS["beans"]->friendService->getFriend($friendID, $userID);
		$travels = $GLOBALS["beans"]->travelService->getTravels($friendID, "future");

		require APP . 'views/_templates/header.php';
		require APP . 'views/friends/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function unfriend($friendID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->friendService->deleteFriend($friendID, $userID);
	
		header('location: ' . URL_WITH_INDEX_FILE . 'friends');
	}
}

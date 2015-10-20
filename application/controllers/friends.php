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
		$friend = $GLOBALS["beans"]->friendService->getSingle($userID, $friendID);
		//$travel = $GLOBALS["beans"]->friendService->getSingle($userID, $friendID);
		//$UserProfile=$GLOBALS["beans"]
		require APP . 'views/_templates/header.php';
		require APP . 'views/friends/view.php';
		require APP . 'views/_templates/footer.php';
	}
}

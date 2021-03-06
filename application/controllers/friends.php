<?php

class Friends
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$friendType = "friends";
		if (array_key_exists("friendType", $_POST))
		{
			$friendType = $_POST["friendType"];
		}
		elseif ($GLOBALS["beans"]->siteHelper->getSession("friendType") != "") {
			$friendType = $GLOBALS["beans"]->siteHelper->getSession("friendType");
			$_SESSION["friendType"] = "";
		}

		$search = "";
		if (array_key_exists("search", $_POST))
		{
			$search = $_POST["search"];
		}

		$friends = $GLOBALS["beans"]->friendService->getFriends($userID, $friendType, $search);

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

	public function add()
	{
		require APP . 'views/_templates/header.php';
		require APP . 'views/friends/add.php';
		require APP . 'views/_templates/footer.php';
	}

	public function delete($friendID, $friendType)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->friendService->deleteFriend($friendID, $userID);

		$_SESSION["friendType"] = $friendType;
		header('location: ' . URL_WITH_INDEX_FILE . 'friends');
	}

	public function searchPotentialFriends()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$potentialFriends = $GLOBALS["beans"]->friendService->searchPotentialFriends($_POST["search"], $userID);

		echo json_encode($potentialFriends);
	}

	public function save()
	{
		$GLOBALS["beans"]->friendService->saveFriends();

		$_SESSION["friendType"] = "pending_friend";
		header('location: ' . URL_WITH_INDEX_FILE . 'friends');
	}

	public function accept($friendID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->friendService->acceptFriend($friendID, $userID);

		$_SESSION["friendType"] = "pending_mine";
		header('location: ' . URL_WITH_INDEX_FILE . 'friends');
	}
}

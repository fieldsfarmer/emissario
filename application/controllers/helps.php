<?php

class Helps
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$wishStatus = "not_closed";
		if (array_key_exists("wishStatus", $_POST))
		{
			$wishStatus = $_POST["wishStatus"];
		}

		$helpStatus = "";
		if (array_key_exists("helpStatus", $_POST))
		{
			$helpStatus = $_POST["helpStatus"];
		}

		$search = "";
		if (array_key_exists("search", $_POST))
		{
			$search = $_POST["search"];
		}

		$helps = $GLOBALS["beans"]->helpService->getHelpsForOthers($userID, $wishStatus, $helpStatus, $search);

		require APP . 'views/_templates/header.php';
		require APP . 'views/helps/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($helpID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$help = $GLOBALS["beans"]->helpService->getHelp($helpID, $userID);
		$messages = $GLOBALS["beans"]->messageService->getMessagesForWish($help->Wish_ID, $userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/helps/view.php';
		require APP . 'views/_templates/footer.php';
	}

}
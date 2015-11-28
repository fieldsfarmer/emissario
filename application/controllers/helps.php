<?php

class Helps
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

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

		$helps = $GLOBALS["beans"]->helpService->getHelpsForOthers($userID, $helpStatus, $search);

		require APP . 'views/_templates/header.php';
		require APP . 'views/helps/index.php';
		require APP . 'views/_templates/footer.php';
	}

}
<?php

class Wishes
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$wishStatus = "not_closed";
		if (array_key_exists("wishStatus", $_POST))
		{
			$wishStatus = $_POST["wishStatus"];
		}

		$search = "";
		if (array_key_exists("search", $_POST))
		{
			$search = $_POST["search"];
		}

		$wishes = $GLOBALS["beans"]->wishService->getWishes($userID, $wishStatus, $search);

		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($wishID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wish = $GLOBALS["beans"]->wishService->getWish($wishID, $userID);
		$helps = $GLOBALS["beans"]->helpService->getHelpsForWish($wishID, $userID);
		$messages = $GLOBALS["beans"]->messageService->getMessagesForWish($wishID, $userID);
	
		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit($wishID = "")
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wish = $GLOBALS["beans"]->wishService->getWish($wishID, $userID, "Open");
		$countries = $GLOBALS["beans"]->resourceService->getCountries();

		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/edit.php';
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$wishID = $GLOBALS["beans"]->wishService->saveWish();

		header('location: ' . URL_WITH_INDEX_FILE . 'wishes/view/' . $wishID);
	}

	public function delete($wishID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->wishService->deleteWish($wishID, $userID);

		header('location: ' . URL_WITH_INDEX_FILE . 'wishes');
	}

	public function close($wishID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->wishService->updateWishStatus($wishID, "Closed", $userID);

		header('location: ' . URL_WITH_INDEX_FILE . 'wishes/view/' . $wishID);
	}

}
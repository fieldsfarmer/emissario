<?php

class Wishes
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wishes = $GLOBALS["beans"]->wishService->getWishes($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($wishID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wish = $GLOBALS["beans"]->wishService->getWish($wishID, $userID);
	
		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit($wishID = "")
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$wish = $GLOBALS["beans"]->wishService->getWish($wishID, $userID);
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

}
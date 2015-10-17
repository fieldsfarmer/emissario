<?php

class Wishes extends Controller
{
	public function index()
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$wishes = $this->beans->wishService->getWishes($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($wishID)
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$wish = $this->beans->wishService->getWish($wishID, $userID);
	
		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit($wishID = "")
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$wish = $this->beans->wishService->getWish($wishID, $userID);
		$countries = $this->beans->resourceService->getCountries();

		require APP . 'views/_templates/header.php';
		require APP . 'views/wishes/edit.php';
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$wishID = $this->beans->wishService->saveWish();

		header('location: ' . URL_WITH_INDEX_FILE . 'wishes/view/' . $wishID);
	}

	public function delete($wishID)
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$this->beans->wishService->deleteWish($wishID, $userID);
	
		header('location: ' . URL_WITH_INDEX_FILE . 'wishes');
	}
}
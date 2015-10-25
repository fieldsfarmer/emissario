<?php

class Travels
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$travelDateType = "future";
		if (array_key_exists("travelDateType", $_POST))
		{
			$travelDateType = $_POST["travelDateType"];
		}

		$search = "";
		if (array_key_exists("search", $_POST))
		{
			$search = $_POST["search"];
		}

		$travels = $GLOBALS["beans"]->travelService->getTravels($userID, $travelDateType, $search);

		require APP . 'views/_templates/header.php';
		require APP . 'views/travels/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($travelID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$travel = $GLOBALS["beans"]->travelService->getTravel($travelID, $userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/travels/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit($travelID = "")
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$travel = $GLOBALS["beans"]->travelService->getTravel($travelID, $userID);
		$countries = $GLOBALS["beans"]->resourceService->getCountries();

		require APP . 'views/_templates/header.php';
		require APP . 'views/travels/edit.php';
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$travelID = $GLOBALS["beans"]->travelService->saveTravel();

		header('location: ' . URL_WITH_INDEX_FILE . 'travels/view/' . $travelID);
	}

	public function delete($travelID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->travelService->deleteTravel($travelID, $userID);

		header('location: ' . URL_WITH_INDEX_FILE . 'travels');
	}

}

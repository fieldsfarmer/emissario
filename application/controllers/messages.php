<?php

class Messages
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$messages = $GLOBALS["beans"]->messageService->getMessages($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($massageID)
	{
		//$massageID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$messages = $GLOBALS["beans"]->messageService->getSingle($massageID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function edit()
	{

		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/edit.php';
		
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$senderID=$senderID;

		$travelID = $GLOBALS["beans"]->messageService->saveMessage();

		//header('location: ' . URL_WITH_INDEX_FILE . 'messages/view/' . $travelID);
	}

	public function delete($travelID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$GLOBALS["beans"]->travelService->deleteTravel($travelID, $userID);

		header('location: ' . URL_WITH_INDEX_FILE . 'messages');
	}

}
<?php

class Messages
{

	public function index()
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");

		$messageType = "received";
		if (array_key_exists("messageType", $_POST))
		{
			$messageType = $_POST["messageType"];
		}
		
		$search = "";
		if (array_key_exists("search", $_POST))
		{
			$search = $_POST["search"];
		}

		$messages = $GLOBALS["beans"]->messageService->getMessages($userID, $messageType, $search);

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/index.php';
		require APP . 'views/_templates/footer.php';
	}

	public function view($messageID)
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		$message = $GLOBALS["beans"]->messageService->getMessage($messageID, $userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/view.php';
		require APP . 'views/_templates/footer.php';
	}

	public function add($originalMessageID = "", $recipientID = "", $wishID = "")
	{
		$userID = $GLOBALS["beans"]->siteHelper->getSession("userID");
		if (is_numeric($originalMessageID) && $originalMessageID > 0) {
			$originalMessage = $GLOBALS["beans"]->messageService->getMessage($originalMessageID, $userID);
		}
		elseif (is_numeric($wishID)) {
			$wish = $GLOBALS["beans"]->messageService->getValidWishForMessage($userID, $wishID, $recipientID);
		}
		else {
			$friends = $GLOBALS["beans"]->friendService->getFriends($userID, "friends");
		}

		require APP . 'views/_templates/header.php';
		require APP . 'views/messages/add.php';
		require APP . 'views/_templates/footer.php';
	}

	public function save()
	{
		$messageID = $GLOBALS["beans"]->messageService->saveMessage();

		header('location: ' . URL_WITH_INDEX_FILE . 'messages/view/' . $messageID);
	}

}
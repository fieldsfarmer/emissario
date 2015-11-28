<?php

class MessageService extends Service
{

	public function getMessages($userID, $messageType = "", $search = "")
	{
		return $this->model->getMessages($userID, $messageType, $search);
	}

	public function getMessage($messageID, $userID = "")
	{
		return $this->model->getMessage($messageID, $userID);
	}

	public function saveMessage()
	{
		return $this->model->insertMessage();
	}

	public function getMessagesForWish($wishID, $userID = "")
	{
		return $this->model->getMessagesForWish($wishID, $userID);
	}

	public function getValidWishForMessage($userID, $wishID, $recipientID)
	{
		return $this->model->getValidWishForMessage($userID, $wishID, $recipientID);
	}

}
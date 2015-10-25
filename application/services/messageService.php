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

	public function getRecipients($userID)
	{
		return $this->model->getRecipients($userID);
	}

	public function saveMessage()
	{
		return $this->model->insertMessage();
	}

}
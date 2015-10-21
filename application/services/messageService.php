<?php

class MessageService extends Service
{

	public function getMessages($userID)
	{
		return $this->model->getMessages($userID);
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
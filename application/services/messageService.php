<?php

class MessageService extends Service
{
	public function getMessages($userID)
	{
		return $this->beans->messageModel->getMessages($userID);
	}
	
	public function getTravel($travelID, $userID = "")
	{
		return $this->beans->travelModel->getTravel($travelID, $userID);
	}
	
	public function saveMessage()
	{
		//$message = $_POST["travelID"];
		$travelID = $this->beans->messageModel->insertMessage();
	
		return $travelID;
	}
	
	public function deleteTravel($travelID, $userID)
	{
		$this->beans->travelModel->deleteTravel($travelID, $userID);
	}
	
}
<?php

class MessageService extends Service
{

	public function getMessages($userID)
	{
		return $this->model->getMessages($userID);
	}
	public function getSingle($userID)
	{
		return $this->model->getSingle($userID);
	}
	
	public function getTravel($travelID, $userID = "")
	{
		return $this->model->getTravel($travelID, $userID);
	}
	
	public function saveMessage()
	{
		//$message = $_POST["travelID"];
		$travelID = $this->model->insertMessage();
	
		return $travelID;
	}
	
	public function deleteTravel($travelID, $userID)
	{
		$this->model->deleteTravel($travelID, $userID);
	}
	
}
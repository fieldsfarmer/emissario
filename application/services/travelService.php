<?php

class TravelService extends Service
{

	public function getTravels($userID)
	{
		return $this->beans->travelModel->getTravels($userID);
	}
	
	public function getTravel($travelID, $userID = "")
	{
		return $this->beans->travelModel->getTravel($travelID, $userID);
	}
	
	public function saveTravel()
	{
		$travelID = $_POST["travelID"];
	
		if (is_numeric($travelID)) {
			$this->beans->travelModel->updateTravel();
		}
		else {
			$travelID = $this->beans->travelModel->insertTravel();
		}
	
		return $travelID;
	}
	
	public function deleteTravel($travelID, $userID)
	{
		$this->beans->travelModel->deleteTravel($travelID, $userID);
	}
}
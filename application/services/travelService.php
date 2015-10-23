<?php

class TravelService extends Service
{

	public function getTravels($userID, $timeSpan = "")
	{
		return $this->model->getTravels($userID, $timeSpan);
	}
	
	public function getTravel($travelID, $userID = "")
	{
		return $this->model->getTravel($travelID, $userID);
	}
	
	public function saveTravel()
	{
		$travelID = $_POST["travelID"];
	
		if (is_numeric($travelID)) {
			$this->model->updateTravel();
		}
		else {
			$travelID = $this->model->insertTravel();
		}
	
		return $travelID;
	}
	
	public function deleteTravel($travelID, $userID)
	{
		$this->model->deleteTravel($travelID, $userID);
	}

}
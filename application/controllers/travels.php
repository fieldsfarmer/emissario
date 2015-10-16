<?php

class Travels extends Controller
{

    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$travels = $this->beans->travelService->getTravels($userID);
    
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/travels/index.php';
    	require APP . 'views/_templates/footer.php';
    }
    
    public function view($travelID)
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$travel = $this->beans->travelService->getTravel($travelID, $userID);
    
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/travels/view.php';
    	require APP . 'views/_templates/footer.php';
    }
    
    public function edit($travelID = "")
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$travel = $this->beans->travelService->getTravel($travelID, $userID);
    
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/travels/edit.php';
    	require APP . 'views/_templates/footer.php';
    }
    
    public function save()
    {
    	$travelID = $this->beans->travelService->saveTravel();
    
    	header('location: ' . URL_WITH_INDEX_FILE . 'travels/view/' . $travelID);
    }
    
    public function delete($travelID)
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$this->beans->travelService->deleteTravel($travelID, $userID);
    
    	header('location: ' . URL_WITH_INDEX_FILE . 'travels');
    }
}

<?php

class Travels extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	//$travels = $this->beans->travelService->getTravels($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/travels/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function edit()
    {
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/travels/edit.php';
    	require APP . 'views/_templates/footer.php';
    }
}

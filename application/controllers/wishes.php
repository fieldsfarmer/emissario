<?php

class Wishes extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	//$wishes = $this->beans->wishService->getWishes($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/wishes/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
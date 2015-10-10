<?php

class Helps extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	//$helps = $this->beans->helpService->getHelps($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/helps/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
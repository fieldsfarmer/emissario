<?php

class Friends extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
        $friends = $this->beans->friendService->getFriends($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/friends/index.php';
        require APP . 'views/_templates/footer.php';
    }

}

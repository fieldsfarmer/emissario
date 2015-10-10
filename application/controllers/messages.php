<?php

class Messages extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	//$messages = $this->beans->messageService->getMessages($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/messages/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
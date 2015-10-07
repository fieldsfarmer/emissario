<?php

class Messages extends Controller
{
    public function index()
    {
        //$messages = $this->beans["messageService"]->getMessages(1);

        require APP . 'views/_templates/header.php';
        require APP . 'views/messages/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
<?php

class Friends extends Controller
{
    public function index()
    {
        $friends = $this->beans["friendService"]->getFriends(1);

        require APP . 'views/_templates/header.php';
        require APP . 'views/friends/index.php';
        require APP . 'views/_templates/footer.php';
    }

}

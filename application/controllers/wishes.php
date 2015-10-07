<?php

class Wishes extends Controller
{
    public function index()
    {
        //$wishes = $this->beans["wishService"]->getWishes(1);

        require APP . 'views/_templates/header.php';
        require APP . 'views/wishes/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
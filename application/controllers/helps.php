<?php

class Helps extends Controller
{
    public function index()
    {
        //$helps = $this->beans["helpService"]->getHelps(1);

        require APP . 'views/_templates/header.php';
        require APP . 'views/helps/index.php';
        require APP . 'views/_templates/footer.php';
    }
}
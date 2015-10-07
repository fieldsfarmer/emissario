<?php

class Travels extends Controller
{
    public function index()
    {
        //$travels = $this->beans["travelService"]->getTravels(1);

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

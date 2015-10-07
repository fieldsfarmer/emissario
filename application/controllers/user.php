<?php

class User extends Controller
{
    public function index()
    {
        $user = $this->beans["userService"]->getUser(1);

        require APP . 'views/_templates/header.php';
        require APP . 'views/user/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function edit()
    {
    	$user = $this->beans["userService"]->getUser(1);
    
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/user/edit.php';
    	require APP . 'views/_templates/footer.php';
    }
    
    public function logout()
    {
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/user/index.php';
    	require APP . 'views/_templates/footer.php';
    }
}

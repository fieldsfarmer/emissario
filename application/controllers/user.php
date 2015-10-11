<?php

class User extends Controller
{
    public function index()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$user = $this->beans->userService->getUser($userID);

        require APP . 'views/_templates/header.php';
        require APP . 'views/user/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function edit()
    {
    	$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
    	$user = $this->beans->userService->getUser($userID);
    
    	require APP . 'views/_templates/header.php';
    	require APP . 'views/user/edit.php';
    	require APP . 'views/_templates/footer.php';
    }

	public function login()
	{
		$errorMessage = $this->beans->userService->login();

		header('location: ' . URL_WITH_INDEX_FILE);
	}

    public function logout()
    {
    	$this->beans->userService->logout();

    	header('location: ' . URL_WITH_INDEX_FILE);
    }
    
    public function save()
    {
    	$this->beans->userService->saveUser();

		if (is_numeric($_POST["userID"]))
		{
			header('location: ' . URL_WITH_INDEX_FILE . 'user/index');
		}
		else
		{
			$this->login();
		}
	}
	
	public function checkUniqueEmail()
	{
		$unique = false;
		$loginInfo = $this->beans->userModel->getLoginInfo($_POST["email"]);

		if (!is_numeric($loginInfo->ID))
		{
			$unique = true;
		}

		var_export($unique);
	}
}

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

	public function signUp()
	{
		$countries = $this->beans->resourceService->getCountries();

		require APP . 'views/_templates/header.php';
		require APP . 'views/user/signUp.php';
		require APP . 'views/_templates/footer.php';
	}

	public function editLogin()
	{
		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$user = $this->beans->userService->getUser($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/user/editLogin.php';
		require APP . 'views/_templates/footer.php';
	}

	public function editProfile()
	{
		$countries = $this->beans->resourceService->getCountries();

		$userID = $GLOBALS["helpers"]->siteHelper->getSession("userID");
		$user = $this->beans->userService->getUser($userID);

		require APP . 'views/_templates/header.php';
		require APP . 'views/user/editProfile.php';
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

	public function createAccount()
	{
		$this->beans->userService->insertUser();
		$this->login();
	}

	public function saveProfile()
	{
		$this->beans->userService->updateProfile();

		header('location: ' . URL_WITH_INDEX_FILE . 'user');
	}

	public function saveLogin()
	{
		$this->beans->userService->updateLogin();

		header('location: ' . URL_WITH_INDEX_FILE . 'user');
	}

	public function checkUniqueEmail()
	{
		$unique = false;
		$loginInfo = $this->beans->userService->getLoginInfo($_POST["email"]);

		if (!is_numeric($loginInfo->ID))
		{
			$unique = true;
		}

		var_export($unique);
	}
}

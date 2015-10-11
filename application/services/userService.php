<?php

class UserService extends Service
{

	public function getUser($user_id)
	{
		return $this->beans->userModel->getUser($user_id);
	}
	
	public function saveUser()
	{
		if (is_numeric($_POST["userID"]))
		{
			$this->beans->userModel->updateUser();
		}
		else
		{
			$this->beans->userModel->insertUser();
		}
	}

	public function login()
	{
		$errorMessage = "Invalid email or password.";
		$loginInfo = $this->beans->userModel->getLoginInfo($_POST["email"]);
		
		if (strcasecmp($_POST["email"],$loginInfo->Email) == 0)
		{
			if (password_verify($_POST["password"],$loginInfo->Password))
			{
				$_SESSION["userID"] = $loginInfo->ID;
				$errorMessage = "";
			}
		}
		
		return $errorMessage;
	}
	
	public function logout()
	{
		// Unset all of the session variables.
		$_SESSION = array();
		
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
			);
		}
		
		// Finally, destroy the session.
		session_destroy();
	}
}
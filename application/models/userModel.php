<?php

class UserModel extends Model
{

	public function getUser($userID)
	{
		$sql = "SELECT User.*, Country.Country_Name, State.State_Name
				FROM User
				LEFT JOIN Country ON Country.Country_Code = User.Country
				LEFT JOIN State ON State.State_Code = User.State
				WHERE User.ID = :user_id";

		$parameters = array(":user_id" => $userID);

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

	public function insertUser() {
		$sql = "INSERT INTO User (First_Name, Last_Name, Email, Password, City, State, Country, Phone, Created_On, Modified_On)
				VALUES (:first_name, :last_name, :email, :password, :city, :state, :country, :phone, NOW(), NOW())";

		$parameters = array(
				":first_name" => $_POST["firstName"],
				":last_name" => $_POST["lastName"],
				":email" => $_POST["email"],
				":password" => password_hash($_POST["password"],PASSWORD_DEFAULT),
				":city" => $_POST["city"],
				":state" => $_POST["state"],
				":country" => $_POST["country"],
				":phone" => $_POST["phone"]
			);

		return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function updateLogin() {
		$sql = "UPDATE User
				SET Email = :email,";
		if ($_POST["password"] != "") {
			$sql .= "Password = :password,";
		}
		$sql .= "Modified_On = NOW()
				WHERE User.ID = :user_id";

		$parameters = array(
				":user_id" => $_POST["userID"],
				":email" => $_POST["email"]
			);
		if ($_POST["password"] != "") {
			$parameters["password"] = password_hash($_POST["password"],PASSWORD_DEFAULT);
		}

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function updateProfile() {
		$sql = "UPDATE User
				SET First_Name = :first_name,
					Last_Name = :last_name,
					City = :city,
					State = :state,
					Country = :country,
					Phone = :phone,
					Modified_On = NOW()
				WHERE User.ID = :user_id";

		$parameters = array(
				":user_id" => $_POST["userID"],
				":first_name" => $_POST["firstName"],
				":last_name" => $_POST["lastName"],
				":city" => $_POST["city"],
				":state" => $_POST["state"],
				":country" => $_POST["country"],
				":phone" => $_POST["phone"]
			);

		$GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function getLoginInfo($email)
	{
		$sql = "SELECT ID, Email, Password
				FROM User
				WHERE Email = :email";

		$parameters = array(":email" => $email);

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

}

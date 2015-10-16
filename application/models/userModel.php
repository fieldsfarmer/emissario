<?php

class UserModel extends Model
{
	public function getUser($userID)
	{
		$sql = "SELECT User.*
        		FROM User
        		WHERE User.ID = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(":user_id" => $userID);
		$query->execute($parameters);
	
		return $GLOBALS["helpers"]->queryHelper->getSingleRowObject($query);
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

		return $GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
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

		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
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

		$GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function getLoginInfo($email)
	{
		$sql = "SELECT ID, Email, Password
        		FROM User
        		WHERE Email = :email";
		$query = $this->db->prepare($sql);
		$parameters = array(":email" => $email);
		$query->execute($parameters);
	
		return $GLOBALS["helpers"]->queryHelper->getSingleRowObject($query);
	}
}

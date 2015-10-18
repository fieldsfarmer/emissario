<?php

class MessageModel extends Model
{

	public function getMessages($userID)
	{
		$sql = "SELECT *,
				User.First_name,
				User.Last_name
				FROM Message, User
				WHERE Message.Recipient_ID = :user_id
				AND	  Message.Sender_ID = User.ID";

		$parameters = array(":user_id" => $userID);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);
		return $query->fetchAll();
	}

	public function insertMessage() {
		$sql = "INSERT INTO message (`ID`, `Sender_ID`, `Recipient_ID`, `Title`, `Content`, `Unread`, `Wish_ID`, `Created_On`, `Modified_On`)
				VALUES(NULL, :Sender_ID,:Recipient_ID,:Title,:Content,b'1',NULL,'2015-10-21 00:00:00', '2015-10-22 00:00:00')";
		$parameters = array(
				":Sender_ID" => $_POST["userID"],
				":Recipient_ID" => $_POST["messageReceiver"],
				":Title" => $_POST["messageTitle"],
				":Content" => $_POST["messageContent"],
		);

		return $GLOBALS["helpers"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

}

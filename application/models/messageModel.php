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
	public function getsingle($massageID)
	{
		$sql = "SELECT *,
				User.First_name,
				User.Last_name
				FROM Message, User
				WHERE Message.ID = :user_id
				AND	  Message.Sender_ID = User.ID";

		$parameters = array(":user_id" => $massageID);

		$query = $this->db->prepare($sql);
		$query->execute($parameters);
		return $query->fetchAll();
	}

	public function insertMessage($id) {

		if($id==NULL){
			$sql0="SELECT User.id
				FROM User
				WHERE User.Email = :user_id";
			$parameter0 = array(":user_id" => $_POST["messageReceiver"]);
			$query = $this->db->prepare($sql0);
			$query->execute($parameter0);
			$uid=$query->fetchAll();
			$sql = "INSERT INTO message (`ID`, `Sender_ID`, `Recipient_ID`, `Title`, `Content`, `Unread`, `Wish_ID`, `Created_On`, `Modified_On`)
					VALUES(NULL, :Sender_ID,:Recipient_ID,:Title,:Content,b'1',NULL,'2015-10-21 00:00:00', '2015-10-22 00:00:00')";
			$parameters = array(
					":Sender_ID" => $_POST["userID"],
					":Recipient_ID" =>$uid[0]->id,
					":Title" => $_POST["messageTitle"],
					":Content" => $_POST["messageContent"],
			);
			return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
		}
		else{
			

		}
	}

}

<?php

class MessageModel extends Model
{

	public function getMessages($userID, $messageType = "", $search = "")
	{
		$sql = "SELECT Message.*,
					Sender.First_name AS Sender_First_Name,
					Sender.Last_name AS Sender_Last_Name,
					Recipient.First_Name AS Recipient_First_Name,
					Recipient.Last_Name AS Recipient_Last_Name,
					DATE_FORMAT(Message.Created_On, '%m/%d/%Y %r') AS Formatted_Created_On
				FROM Message
				INNER JOIN User Sender ON Sender.ID = Message.Sender_ID
				INNER JOIN User Recipient ON Recipient.ID = Message.Recipient_ID
				WHERE";

		if (strcasecmp($messageType, "received") == 0)
		{
			$sql .= " Message.Recipient_ID = :user_id";
		}
		else if (strcasecmp($messageType, "sent") == 0)
		{
			$sql .= " Message.Sender_ID = :user_id";
		}
		else
		{
			$sql .= " (Message.Recipient_ID = :user_id
						OR Message.Sender_ID = :user_id)";
		}
		
		if (trim($search) != "")
		{
			$sql .= " AND (Message.Title LIKE :search
						OR Message.Content LIKE :search
						OR CONCAT(Sender.First_Name, ' ', Sender.Last_Name) LIKE :search
						OR CONCAT(Recipient.First_Name, ' ', Recipient.Last_Name) LIKE :search)";
		}
		
		$sql .= " ORDER BY Message.Created_On DESC";

		$parameters = array(":user_id" => $userID);
		if (trim($search) != "")
		{
			$parameters[":search"] = "%" . trim($search) . "%";
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	public function getMessage($messageID, $userID = "")
	{
		$sql = "SELECT Message.*,
					Sender.First_name AS Sender_First_Name,
					Sender.Last_name AS Sender_Last_Name,
					Recipient.First_Name AS Recipient_First_Name,
					Recipient.Last_Name AS Recipient_Last_Name,
					DATE_FORMAT(Message.Created_On, '%m/%d/%Y %r') AS Formatted_Created_On,
					Wish.Description AS Wish_Description,
					Wish.User_ID AS Wish_Owner_ID";

		if (is_numeric($userID)) {
			$sql .= " ,(SELECT Help.ID
					FROM Help
					WHERE Help.Wish_ID = Wish.ID
						AND Help.User_ID = :user_id
					LIMIT 1) AS Help_ID";
		}

		$sql .= " FROM Message
				INNER JOIN User Sender ON Sender.ID = Message.Sender_ID
				INNER JOIN User Recipient ON Recipient.ID = Message.Recipient_ID
				LEFT JOIN Wish ON Wish.ID = Message.Wish_ID
				WHERE Message.ID = :message_id";

		if (is_numeric($userID)) {
			$sql .= " AND (Message.Recipient_ID = :user_id
						OR Message.Sender_ID = :user_id)";
		}

		$parameters = array(':message_id' => $messageID);
		if (is_numeric($userID)) {
			$parameters[":user_id"] = $userID;
		}

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

	public function insertMessage() {
		$sql = "INSERT INTO Message (Sender_ID, Recipient_ID, Title, Content, Wish_ID, Created_On, Modified_On)
				VALUES (:sender_id, :recipient_id, :title, :content, :wish_id, NOW(), NOW())";

		$parameters = array(
				":sender_id" => $_POST["userID"],
				":recipient_id" => $_POST["recipientID"],
				":title" => $_POST["title"],
				":content" => $_POST["content"],
				":wish_id" => $_POST["wishID"]
		);

		return $GLOBALS["beans"]->queryHelper->executeWriteQuery($this->db, $sql, $parameters);
	}

	public function getMessagesForWish($wishID, $userID = "")
	{
		$sql = "SELECT Message.*,
					Sender.First_name AS Sender_First_Name,
					Sender.Last_name AS Sender_Last_Name,
					Recipient.First_Name AS Recipient_First_Name,
					Recipient.Last_Name AS Recipient_Last_Name,
					DATE_FORMAT(Message.Created_On, '%m/%d/%Y %r') AS Formatted_Created_On
				FROM Message
				INNER JOIN Wish ON Wish.ID = Message.Wish_ID
				INNER JOIN User Sender ON Sender.ID = Message.Sender_ID
				INNER JOIN User Recipient ON Recipient.ID = Message.Recipient_ID
				WHERE Message.Wish_ID = :wish_id";

		if (is_numeric($userID)) {
			$sql .= " AND (Wish.User_ID = :user_id
						OR Message.Recipient_ID = :user_id
						OR Message.Sender_ID = :user_id)";
		}

		$sql .= " ORDER BY Message.Created_On DESC";

		$parameters = array(":wish_id" => $wishID);
		if (is_numeric($userID))
		{
			$parameters[":user_id"] = $userID;
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

	/* If the wish belongs to the user, then the recipient has to be one of the potential helpers.
	 * If the user is one of the potential helpers for a wish, then the recipient has to be the wish owner.
	 * Otherwise the wish is not valid for sending a message.
	 * This is to prevent bad users randomly changing IDs through the address bar. */
	public function getValidWishForMessage($userID, $wishID, $recipientID)
	{
		$sql = "SELECT 'Wish' AS Type,
					Wish.ID,
					Wish.Description,
					Wish.ID AS Link_ID,
					Recipient.ID AS Valid_Recipient_ID,
					Recipient.First_Name AS Valid_Recipient_First_Name,
					Recipient.Last_Name AS Valid_Recipient_Last_Name
				FROM Wish
				LEFT JOIN Help ON Help.Wish_ID = Wish.ID AND Help.User_ID = :recipient_id
				LEFT JOIN User Recipient ON Recipient.ID = Help.User_ID
				WHERE Wish.ID = :wish_id
					AND Wish.User_ID = :user_id
				UNION
				SELECT 'Help' AS Type,
					Wish.ID,
					Wish.Description,
					Help.ID AS Link_ID,
					Recipient.ID AS Valid_Recipient_ID,
					Recipient.First_Name AS Valid_Recipient_First_Name,
					Recipient.Last_Name AS Valid_Recipient_Last_Name
				FROM Help
				INNER JOIN Wish ON Wish.ID = Help.Wish_ID
				LEFT JOIN User Recipient ON Recipient.ID = Wish.User_ID AND Recipient.ID = :recipient_id
				WHERE Help.Wish_ID = :wish_id
					AND Help.User_ID = :user_id";

		$parameters = array(
				':user_id' => $userID,
				':wish_id' => $wishID,
				':recipient_id' => $recipientID
		);

		return $GLOBALS["beans"]->queryHelper->getSingleRowObject($this->db, $sql, $parameters);
	}

}
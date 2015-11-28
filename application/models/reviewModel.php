<?php

class ReviewModel extends Model
{

	public function getReviews($userID, $reviewType, $recommended = "")
	{
		$sql = "SELECT Review.*,
					Help.Wish_ID,
					User.First_Name AS User_First_Name,
					User.Last_Name AS User_Last_Name,
					Reviewer.First_Name AS Reviewer_First_Name,
					Reviewer.Last_Name AS Reviewer_Last_Name
				FROM Review
				INNER JOIN Help ON Help.ID = Review.Help_ID
				INNER JOIN User ON User.ID = Review.User_ID
				LEFT JOIN User Reviewer ON Reviewer.ID = Review.Created_By
				WHERE ";

		if (strcasecmp($reviewType, "written") == 0)
		{
			$sql .= " Review.Created_By = :user_id";
		}
		else
		{
			$sql .= " Review.User_ID = :user_id";
		}

		if (is_numeric($recommended))
		{
			$sql .= " AND Review.Recommended = :recommended";
		}

		$sql .= " ORDER BY Review.Created_On DESC";

		$parameters = array(":user_id" => $userID);
		if (is_numeric($recommended))
		{
			$parameters[":recommended"] = $recommended;
		}

		$query = $this->db->prepare($sql);
		$query->execute($parameters);

		return $query->fetchAll();
	}

}
<?php
	
	function GetUserInformationDB1P($tableName)
	{
		require 'DB.php';

		$userInfomationSql = 'SELECT * FROM ' . $tableName;

		$result = $conn->query($userInfomationSql);

		// if($result->num_rows > 0)
		// {
		// 	$row = $result->fetch_assoc();
		// }

		return $result;
	}

	function GetUserInformation2P($tableName, $columnName)
	{
		require 'DB.php';

		$userInfomationSql = 'SELECT * FROM ' . $tableName . ' WHERE  EmailID = ' . '"' . $columnName . '"';

		$result = $conn->query($userInfomationSql);

		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
		}

		return $row;
	}

	function GetUserInformationBySearch($searchValue)
	{
		require 'DB.php';

		$userInfomationSql = 'SELECT * FROM `user` WHERE Division LIKE ' . "'" . '%'. $searchValue . '%' . "'" . ' OR District LIKE ' . "'" . '%' . $searchValue . '%' . "'" .' OR Area LIKE ' . "'" . '%' . $searchValue . '%' . "'" . ' OR BloodGroup LIKE ' . "'" . '%' . $searchValue . '%' . "'";

		$result = $conn->query($userInfomationSql);
		
		return $result;
	}

	function UserRating($donarId, $ratingValue, $userId)
	{
		require 'DB.php';

		$insertUserInfoSql = 'INSERT INTO `rating`(`UserId`, `Rating`, `RatingById`) VALUES ( ' . '"' . $donarId . '","' . $ratingValue . '","' . $userId . '")';

		if(mysqli_query($conn,$insertUserInfoSql))
		{
			echo "<script>alert('User rate has been successfuly added.');</script>";
		}else{
			echo "<br />Error: " . mysqli_error($conn);
		}
	}

	function GetUserRate($tableName, $columnName)
	{
		require 'DB.php';

		$values = 0;

		$user = GetUserInformation2P('User', $columnName);
		$userInfomationSql2 = 'SELECT (SUM(rating)/ (COUNT(UserId)*5))*100 as Result FROM ' . $tableName . ' WHERE  UserId = ' . '"' . $user['Id'] . '"';

		// SELECT (SUM(rating)/ (COUNT(UserId)*5))*100 as Rating from rating WHERE UserId = 5

		$result2 = $conn->query($userInfomationSql2);

		if($result2->num_rows > 0)
		{
			 while ($row = $result2->fetch_assoc()) {
			 	if (empty($row['Result'])) {
			 		$values = 0;
			 	}else{
			 		$values = round($row['Result'],2);
			 	}
			 }
		}

		return $values;
	}
?>

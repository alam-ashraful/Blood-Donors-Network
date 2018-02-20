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

		echo $insertUserInfoSql;

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

		$userInfomationSql1 = 'SELECT * FROM ' . $tableName . ' WHERE  UserId = ' . '"' . $user['Id'] . '"';
		$userInfomationSql2 = 'SELECT SUM(rating) as value_sum FROM ' . $tableName . ' WHERE  UserId = ' . '"' . $user['Id'] . '"';
		$result1 = $conn->query($userInfomationSql1);
		$result2 = $conn->query($userInfomationSql2);

		$count = 0;
		if($result1->num_rows > 0)
		{
			while($row1 = $result1->fetch_assoc()){
				$count++;
			}
		}

		if($count >0 && $result2->num_rows > 0)
		{
			while($row2 = $result2->fetch_assoc()){
				$values = ($row2['value_sum']*100)/($count*5);
			}
		}
		
		return $values;
	}
?>
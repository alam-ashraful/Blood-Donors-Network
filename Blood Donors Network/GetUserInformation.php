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
		$ratingValue = 0;
		$count = 0;
		$rowCount = 0;
		$row = 0;

		$userInfomationSql = 'SELECT * FROM ' . $tableName . ' WHERE  EmailID = ' . '"' . $columnName . '"';

	// 	if($result = mysqli_query($conn,$userInfomationSql)){
	// 	$rowCount = mysql_num_rows($result);
	// }
	// if(!$rowCount = 0)
	// 	{
	// 		$row = $row->fetch_assoc();
	// 		while(!$row){
	// 			$ratingValue+=($row['Rating']*100)/5;
	// 			$count+=1;
	// 			return $ratingValue/=$count;
	// 		}
	// 	}else{
	// 		return 0;
	// 	}

		$result = $conn->query($userInfomationSql);
		$rowCount = $result->num_rows;

		if($rowCount > 0)
		{
			while ($row = $result->fetch_array()) {
				$ratingValue+=($row['Rating']*100)/5;
				$count+=1;
				$ratingValue/=$count;
			}
		}
		return $ratingValue;
	}
?>
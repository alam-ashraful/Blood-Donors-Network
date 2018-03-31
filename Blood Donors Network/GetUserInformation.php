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

	function GetUserInformationBySearch($searchValue, $area1)
	{
		require 'DB.php';

		// SELECT Area2, PathCost FROM distancevector WHERE Area1 = "Badda" AND PathCost<20

		$getArea1Sql = 'SELECT Area2 FROM distancevector WHERE Area1 = ' . '"' . $area1 . '"' . ' AND PathCost<20';

		echo $getArea1Sql;

		$area1Result = $conn->query($getArea1Sql);

		if($area1Result->num_rows > 0)
		{
			$f = $area1Result->fetch_assoc();
		}else{
			$f['Area2']="";
		}

		// echo $f['Area2'];
		// Division LIKE ' . "'" . '%'. $searchValue . '%' . "'" . ' OR District LIKE ' . "'" . '%' . $searchValue . '%' . "'" .' OR

		$userInfomationSql = 'SELECT * FROM `user` WHERE  Area LIKE ' . "'" . '%' . $f['Area2'] . '%' . "'" . ' AND BloodGroup LIKE ' . "'" . '' . $searchValue . '' . "'";

		echo "<br />";
		echo $userInfomationSql;

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

	function DistanceVectorTable($area1Name, $area2Name, $distance){
		require 'DB.php';

		$insertDistanceInfoSql = 'INSERT INTO `distancevector`(`Area1`, `FromDistance`, `Area2`, `ToDistance`, `PathCost`) VALUES ( ' . '"' . $area1Name . '",' . '0' . ',"' . $area2Name . '",' . '0' . ',' . $distance . ')';

		// echo $insertDistanceInfoSql;

		if(mysqli_query($conn,$insertDistanceInfoSql))
		{
			echo "<script>alert('Custom distance successfuly added.');</script>";
		}else{
			echo "<br />Error: " . mysqli_error($conn);
		}
	}

	function GetDistanceVectorTableValue()
	{
		require 'DB.php';

		$userInfomationSql = 'SELECT FromDistance, ToDistance, PathCost FROM distancevector';

		$result = $conn->query($userInfomationSql);

		// if($result->num_rows > 0)
		// {
		// 	$row = $result->fetch_assoc();
		// }

		return $result;
	}

	function updateAdminInfo($firstName, $lastName, $email)
	{
		require 'DB.php';
		// UPDATE `admin` SET `Id`=[value-1],`FirstName`=[value-2],`LastName`=[value-3],`EmailID`=[value-4],`Password`=[value-5],`PhoneNumber`=[value-6],`BirthDate`=[value-7],`Gender`=[value-8],`BloodGroup`=[value-9],`Division`=[value-10],`District`=[value-11],`Area`=[value-12] WHERE 1
		$updateAdminInfo = 'Update admin set "' . '"' . 'FirstName = ' . '"' . $firstName . '",' . 'LastName = ' . '"' . $lastName . '"' . ' WHERE EmailID = ' . '"' . $email . '"';

		echo $updateAdminInfo;

		$result = $conn->query($updateAdminInfo);

		if($result->fetch_assoc() == 0)
		{
			echo "<script>Information update failed</script>";
		}else{
			echo "<script>Information updated</script>";
		}
	}

	function getArea1()
	{
		require 'DB.php';

		$userInfomationSql = 'SELECT distinct(Area1) from distancevector';

		$result = $conn->query($userInfomationSql);

		return $result;
	}

	function GetBloodGroup(){
		require 'DB.php';

		$userInfomationSql = 'SELECT * FROM bloodgroup';

		$result = $conn->query($userInfomationSql);
		return $result;
	}
?>
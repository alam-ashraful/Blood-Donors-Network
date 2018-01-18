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
?>
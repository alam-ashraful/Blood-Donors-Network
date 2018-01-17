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
?>
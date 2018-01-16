<?php
	
	function GetUserInformationDB1P($tablename)
	{
		return "table name";
	}

	function GetUserInformation2P($tableName, $columnName)
	{
		require_once 'DB.php';

		$userInfomationSql = 'SELECT * FROM ' . $tableName . ' WHERE  EmailID = ' . '"' . $columnName . '"';

		$result = $conn->query($userInfomationSql);

		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
		}

		return $row;
	}
?>
<?php
	require_once 'DB.php';

	$result = $conn->query("SELECT * FROM Admin WHERE EmailID ='$emailID'");
	$resultUser = $conn->query("SELECT * FROM User WHERE EmailID ='$emailID'");


	if($result->num_rows > 1 || $resultUser->num_rows > 1){
		echo '<script language="javascript">';
		echo 'alert("Email ID already exist.\nTry with another email.")';
		echo '</script>';
	}else{
		$insertUserInfoSql = 'INSERT INTO `user`(`FirstName`, `LastName`, `EmailID`, `Password`, `PhoneNumber`, `BirthDate`, `Gender`, `BloodGroup`, `Division`, `District`, `Area`, `Status`) VALUES (' . '"' . $firstName . '","' . $lastName . '","' . $emailID . '","' . $password . '","' . $phoneNumber . '","' . $birthDate . '","' . $gender . '","' . $bloodGroup . '","' . $division . '","' . $district . '","' . $area . '","' . 'Yes' . '"'. ')';

		if(mysqli_query($conn,$insertUserInfoSql))
		{
			echo "<script>alert('Information successfully updated.');</script>";
			sleep(3);
			header("location: UserDash.php");
		}else{
			echo "<br />Error: " . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
?>
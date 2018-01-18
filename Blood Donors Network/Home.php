<?php
	session_start();

	require 'GetUserInformation.php';

	$getAllUserInfo = GetUserInformationDB1P("User");

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if (isset($_POST["searchBtn"])) {
			if (!empty($_POST["search"])) {
				$getAllUserInfo =  GetUserInformationBySearch($_POST["search"]);
			}else{
				echo "Please type Division/District/Area name on search box";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home | Blood Donors Network</title>
	<meta charset="utf-8">
	<style>
	table {
	    border-collapse: collapse;
	    width: 100%;
	}

	td, th {
	    border: 3px solid #dddddd;
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even) {
	    background-color: #ffffff;
	}
	.MainContent{
		font-family: Harrington;
		text-align: center;
	}
</style>
</head>
<body class="MainContent">
	<h1>Welcome to Blood Donors Network</h1>
	<a style="text-decoration: none; color: green;" href="<?php
	$name = '';
	if (isset($_SESSION['logged_in']) && $_SESSION['Type']=='User') {
		$name = 'My Profile <br /><br />';
		echo 'UserDash.php';
	}else if (isset($_SESSION['logged_in']) && $_SESSION['Type']=='Admin') {
		$name = 'My Profile <br /><br />';
		echo 'AdminDash.php';
	}else{
		$name = '';
	}
		?>"><?php echo $name; ?></a>
	<label>
		<?php
			if (isset($_SESSION['logged_in']) && $_SESSION['Type']=="User") {
				$row = GetUserInformation2P($_SESSION['Type'],$_SESSION['EmailID']);
				echo "Hi, " . $row['FirstName'] . "<br /><br />";
			}else if (isset($_SESSION['logged_in']) && $_SESSION['Type']=="Admin") {
				$row = GetUserInformation2P($_SESSION['Type'],$_SESSION['EmailID']);
				echo "Hi, " . $row['FirstName'] . "<br /><br />";
			}else{
				echo "Please <a style= '" . 'text-decoration: none; color: cyan' . "' href='" . 'Login.php' . "'>Login</a> to rate user" . "<br /><br />";
			}
		?>
	</label>
	<table>
		<tr>
			<th colspan="6">
				<form method="POST">
					Search donar : <input style="width: 50%; color: green;" type="text" name="search" title="Search donar by Blood Group/Division/District/Area" placeholder="Search donar by Blood Group/Division/District/Area" autocomplete="on">
					<input type="submit" name="searchBtn" value="Search">
				</form>
			</th>
		</tr>
		<tr>
			<th colspan="6" style="text-align: center;">User information : </th>
		</tr>
		<tr>
			<th>Full name</th>
			<th>Blood group</th>
			<th>Phone number</th>
			<th>Want to donate blood?</th>
			<th>Living history</th>
			<th>Reguest for blood</th>
		</tr>
		<?php
			if($getAllUserInfo->num_rows > 0){
				while ($rowValue = $getAllUserInfo->fetch_assoc()) {
				?>
			<tr>
				<td><?php echo $rowValue['FirstName'] . " " . $rowValue['LastName']; ?></td>
				<td><?php echo $rowValue['BloodGroup']; ?></td>
				<td><?php echo $rowValue['PhoneNumber']; ?></td>
				<td><?php echo $rowValue['Status']; ?></td>
				<td>
					Division : <?php echo $rowValue['Division'] ?><br />District : <?php echo $rowValue['District']; ?><br />Area: <?php echo $rowValue['Area']; ?>
				</td>
				<td><input type="submit" name="sendBloodRequest" value="Request for Blood"></td>
			</tr>
			<tr>
				<th colspan="6">
					Ratings: 0% <!-- later from db -->
					<br />&#10004; Rate this user
					<input type="radio" name="userRate" value="1"><label>1</label>
					<input type="radio" name="userRate" value="2"><label>2</label>
					<input type="radio" name="userRate" value="3"><label>3</label>
					<input type="radio" name="userRate" value="4"><label>4</label>
					<input type="radio" name="userRate" value="5"><label>5</label>
				</th>
			</tr>
		<?php
				}
			}else{
				?>
				<tr>
					<td colspan="6" style="color: red; text-align: center;">There's no data found.</td>
				</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
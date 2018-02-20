
<?php
	require('GetUserInformation.php');

	$row = GetUserInformation2P('User', $_GET['email']);
	$rating = GetUserRate('Rating', $_GET['email']);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Donar profile</title>
	<meta charset="utf-8">
</head>
<body>
	<fieldset>
		<legend>Donar Profile</legend>
		<form method="post">
			<table>
				<tr>
					<td>Username</td>
					<td>:</td>
					<td><?php echo $row['FirstName'];  ?></td>
				</tr>
				<tr>
					<td>Phone number</td>
					<td>:</td>
					<td><?php echo $row['PhoneNumber']; ?></td>
				</tr>
				<tr>
					<td>Birth date</td>
					<td>:</td>
					<td><?php echo $row['BirthDate']; ?></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>:</td>
					<td><?php echo $row['Gender']; ?></td>
				</tr>
				<tr>
					<td>Blood Group</td>
					<td>:</td>
					<td><?php echo $row['BloodGroup']; ?></td>
				</tr>
				<tr>
					<td>Liviving history</td>
					<td>:</td>
					<td><label>Division<hr /></label><?php echo $row['Division']; ?></td>
					<td><label>District<hr /></label><?php echo $row['District']; ?></td>
					<td><label>Area<hr /></label><?php echo $row['Area']; ?></td>
				</tr>
				<tr>
					<td>Ratings</td>
					<td>:</td>
					<td>
						<?php
							$value = GetUserRate('Rating', $_GET['email']);
							echo $value . "%";
						?>
					</td>
				</tr>
			</table>
		</form>
		<label>Go to <a href="home.php">donar list</a></label>
	</fieldset>
</body>
</html>
<?php
	session_start();

	require 'GetUserInformation.php';
	$getAllUserInfo = GetUserInformationDB1P("User");

	$fErr = "";
	$bG = "";

	$bGr = GetBloodGroup();
	

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if (isset($_POST["searchBtn"]) || isset($_POST['furtherSearch'])) {

			if(isset($_POST['searchBtn'])){
				if (!empty($_POST["search"]) || !empty($_POST['area1'])) {
					$getAllUserInfo =  GetUserInformationBySearch($_POST["search"], $_POST['area1']);
				}else{
					echo "Please type Division/District/Area name on search box";
				}
			}

			// if(isset($_POST['furtherSearch'])){
			// 	if(empty($_POST['search'])){
			// 		$fErr = "Please type an blood group";
			// 	}else
			// 	{
			// 		$getAllUserInfo = GetUserInformationBySearch($_POST['search'], $_POST['area1']);
			// 	}
			// }
		}

			if (isset($_POST["rateUSerBtn"])) {
				if(isset($_SESSION['logged_in']) && ($_SESSION['Type']=="Admin" || $_SESSION['Type']=="User" ) && !empty($_POST['userRate'])){
					//require 'GetUserInformation.php';
					$rowl = GetUserInformation2P($_SESSION['Type'],$_SESSION['EmailID']);
					$_SESSION['donarId'] = $_GET['donarId'];
					if($_SESSION['donarId']==$rowl['Id']){
						echo "<div class=\"alert alert-warning\"><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>
						Nice try! You can not rate yourself</div>";
					}else{
						UserRating($_SESSION['donarId'], $_POST['userRate'], $rowl['Id']);
					}
				}else{
					echo "<div class=\"alert alert-warning\"><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>
					Please log in to rate user</div>";
				}
			}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home | Blood Donors Network</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
			<th colspan="7">
				<form method="POST">
					Search donar :
					<select name="area1">
						<?php $ar = getArea1();
						while($r = $ar->fetch_assoc()){ ?>
					  		<option value="<?php echo $r['Area']; ?>"><?php echo $r['Area']; ?></option>
					 	<?php } ?>
					</select>
					<select name="search">
						<?php while($b = $bGr->fetch_assoc()) { ?>
					  <option value="<?php echo $b['BloodGroupName']; ?>"><?php echo $b['BloodGroupName']; ?></option>
					  <?php } ?>
					  <!-- <span class="error"><?php echo $bloodGroupErr; ?></span> -->
					</select>
					<!-- <input style="width: 50%; color: green;" type="text" name="search" title="Search donar by Blood Group/Division/District/Area" placeholder="Search donar by Blood Group/Division/District/Area" autocomplete="on"> -->
					<input type="submit" name="searchBtn" value="Search">
					<span><?php echo $fErr ?></span>
				</form>
			</th>
		</tr>
		<tr>
			<th colspan="7" style="text-align: center;">User information : </th>
		</tr>
		<tr>
			<th>Full name</th>
			<th>Blood group</th>
			<th>Phone number</th>
			<th>Want to donate blood?</th>
			<th>Living history</th>
			<th>Reguest for blood</th>
			<th>See profile</th>
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
				<td><a href="CheckUser.php?email=<?php echo $rowValue['EmailID'] ?>">View profile</a></td>
			</tr>
			<tr>
				<th colspan="7">
					<form method="POST" action="Home.php?donarId=<?php echo $rowValue['Id']; ?>">
					<label>Ratings: </label>
					<?php
							$value = GetUserRate('Rating', $rowValue['EmailID']);
							echo $value . "%";
					?>
					<br />&#10004; Rate this user
					<input type="radio" name="userRate" value="1"><label>1</label>
					<input type="radio" name="userRate" value="2"><label>2</label>
					<input type="radio" name="userRate" value="3"><label>3</label>
					<input type="radio" name="userRate" value="4"><label>4</label>
					<input type="radio" name="userRate" value="5"><label>5</label>
					<label><br />Tap Ok to rate this user : </label>
					<input type="submit" name="rateUSerBtn" value="Ok">
				</form>
				</th>
			</tr>
		<?php
				}
			}else{
				?>
				<tr>
					<form method="POST">
					<td colspan="7" style="color: red; text-align: center;">There's no data found. <input style="background-color: cyan;" type="submit" name="furtherSearch" value="furtherSearch"></td>
				</form>
				</tr>
		<?php
			}
		?>
	</table>
</body>
<script type="text/javascript">
	function test(argument) {
		$.ajax{
			type: 'GET',
			url: 'localhost:8080/',
			success(result,status,xhr){
				return result;
			}
		}
	}
</script>
</html>
<?php
	session_start();

	if(isset($_SESSION['logged_in']) && $_SESSION['Type']=="Admin"){
		require_once 'GetUserInformation.php';
		$getAdminInfo = GetUserInformation2P("Admin",$_SESSION['EmailID']);
		$st ="";
	}else{
		if ($_SESSION['Type']=="User") {
			header("location: UserDash.php");
		}else{
			header("location: Login.php");
		}
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(isset($_POST['logOut'])){
			session_unset();
			session_destroy();
			header("location: Login.php");
		}else if(isset($_POST['update'])){
			$firstName = test_input($_POST["firstname"]);
			$lastName = test_input($_POST["lastname"]);
			// $emailID = test_input($_POST["email"]);
			require 'DB.php';
			$password = $conn->escape_string(password_hash($_POST["password"], PASSWORD_BCRYPT));
			$phoneNumber = test_input($_POST["phone"]);
			$birthDate = $_POST["birthDate"];
			$gender = $_POST["gender"];
			// $bloodGroup = test_input($_POST["bloodGroup"]);
			$division = test_input($_POST["division"]);
			$district = test_input($_POST["district"]);
			$area = test_input($_POST["area"]);

		if (!empty($_POST["firstname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["birthDate"]) && !empty($_POST["gender"]) && !empty($_POST["division"]) && !empty($_POST["district"])) {
			
				require 'GetUserInformation.php';

				updateAdminInfo($_POST['firstname'], $_POST['lastname'], $_POST['email']);
				// {
				// 	echo "<script>alert('Information saved..')</script>";
				// }else{
				// 	echo "<script>alert('Information failed to save..')</script>";
				// }
			}
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin | Blood Donors Network</title>
	<meta charset="utf-8">
	<style type="text/css">
		.MainContent{
			text-align: center;
			font-family: Harrington;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body class="MainContent">
	<nav class="navbar navbar-dark bg-dark">
	  <a class="navbar-brand"></a>
	  <form class="form-inline">
	  	<label class="form-control mr-sm-2"><a href="/Blood Donors Network/AdminDashUpdate.php">Update area</a></label>
	    <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
	    <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
	  </form>
	</nav>

	<h1>Welcome to Blood Donors Network</h1>
	<label>Go to <a href="/Blood Donors Network/Home.php"><p><i class="material-icons w3-spin w3-jumbo">home</i></p></a></label>
		<p>Hi, <?php echo $getAdminInfo['FirstName']?> </p>

			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				
				<div class="inputbox">
					<lable>First Name : </label> 
					<input type="text" name="firstname" value='<?php echo $getAdminInfo['FirstName']; ?>' required="">
					<br /><br />
				</div>

				<div class="inputbox">
					<label>Last Name : </label>
					<input type="text" name="lastname" value="<?php echo $getAdminInfo['LastName']; ?>" required="">
					<br /><br />
				</div>

				<div class="inputbox">
					<lable>Email ID : </lable>
					<input type="email" name="email" value="<?php echo $getAdminInfo['EmailID']; ?>" disabled>
					<br /><br />
				</div>

				<div class="inputbox">
					<lable>Password : </lable>
					<input type="password" name="password" value="<?php echo $getAdminInfo['Password']; ?>" required="">
					<br /><br />
			    </div>

				<div class="inputbox">
					<lable>Phone Number :</lable>
					<input type="text" name="phone" value="<?php echo $getAdminInfo['PhoneNumber']; ?>" required="">
					<br /><br />
				</div>

				<div class="inputbox">
					<label>Birth Date : </label>
					<input type="Date" name="birthDate" value="<?php echo $getAdminInfo['BirthDate']; ?>">
					<br><br>
			    </div>

			    <label>Gender : 
			    	<input type="text" name="gender" value="<?php echo $getAdminInfo['Gender']; ?>">
			    </label>
			    <br /><br />

			    <label>Blood Group : </label>
			    <select id="soflow" name="bloodGroup">
				  <option value="A+" <?php if($getAdminInfo['BloodGroup']=="A+"){echo "selected";}?>>A+</option>
				  <option value="A-" <?php if($getAdminInfo['BloodGroup']=="A-"){echo "selected";} ?>>A-</option>
				  <option value="AB+" <?php if($getAdminInfo['BloodGroup']=="AB+"){echo "selected";} ?>>AB+</option>
				  <option value="AB-" <?php if($getAdminInfo['BloodGroup']=="AB-"){echo "selected";} ?>>AB-</option>
				  <option value="B+" <?php if($getAdminInfo['BloodGroup']=="B+"){echo "selected";} ?>>B+</option>
				  <option value="B-" <?php if($getAdminInfo['BloodGroup']=="B-"){echo "selected";} ?>>B-</option>
				  <option value="O+" <?php if($getAdminInfo['BloodGroup']=="O+"){echo "selected";} ?>>O+</option>
				  <option value="O-" <?php if($getAdminInfo['BloodGroup']=="O-"){echo "selected";} ?>>O-</option>
				  <span class="error"><?php echo $bloodGroupErr; ?></span>
				</select>
				<br />
				<br />

			    <!-- <label>Blood Group : <?php echo $getAdminInfo['BloodGroup']; ?></label>
			    <br /><br /> -->

			    <div class="inputbox">
					<lable>Division :</lable>
					<input type="text" name="division" value="<?php echo $getAdminInfo['Division']; ?>" required="">
					<br /><br />
				</div>

				<div class="inputbox">
					<lable>District :</lable>
					<input type="text" name="district" value="<?php echo $getAdminInfo['District']; ?>" required="">
					<br /><br />
				</div>

				<div class="inputbox">
					<lable>Area :</lable>
					<input type="text" name="area" value="<?php echo $getAdminInfo['Area']; ?>" required="">
					<br /><br />
				</div>
				
				<input type="submit" name="update" value="Update">
				<input type="submit" name="logOut" value="Log out">
			</form>	
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
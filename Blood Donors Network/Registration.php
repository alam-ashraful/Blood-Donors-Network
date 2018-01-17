<?php
	$fnameErr = $lnameErr = $emailErr = $passwordErr = $phoneNumberErr = $birthDateErr = $genderErr = $bloodGroupErr = $divisionNameErr = $districtNameErr = $areaNameErr = "";
	$firstName = $lastName = $emailID = $password = $phoneNumber = $birthDate = $gender = $bloodGroup = $division = $district = $area = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["firstName"])){
			$fnameErr = "First name is required.";
		}if(empty($_POST["lastName"])){
			$lnameErr = "Last name is required.";
		}if(empty($_POST["email"])){
			$emailErr = "Email id is required.";
		}if(empty($_POST["password"])){
			$passwordErr = "Password is required.";
		}if(empty($_POST["phoneNumber"])){
			$phoneNumberErr = "Phone number is required.";
		}if(empty($_POST["birthDate"])){
			$birthDateErr = "Birth date is required.";
		}if(empty($_POST["gender"])){
			$genderErr = "<br />Gender is required.";
		}if(!isset($_POST["bloodGroup"])){
			$bloodGroupErr = "Please select a blood group.";
		}if (!isset($_POST["division"])) {
			$divisionNameErr = "Please select a division.";
		}if(empty($_POST["district"])){
			$districtNameErr = "District name is required.";
		}if(empty($_POST["area"])){
			$areaNameErr = "Area name is required";
		}
		else
		{
			$firstName = test_input($_POST["firstName"]);
			$lastName = test_input($_POST["lastName"]);
			$emailID = test_input($_POST["email"]);
			require 'DB.php';
			$password = $conn->escape_string(password_hash($_POST["password"], PASSWORD_BCRYPT));
			$phoneNumber = test_input($_POST["phoneNumber"]);
			$birthDate = $_POST["birthDate"];
			$gender = $_POST["gender"];
			$bloodGroup = test_input($_POST["bloodGroup"]);
			$division = test_input($_POST["division"]);
			$district = test_input($_POST["district"]);
			$area = test_input($_POST["area"]);
		}

		if (!empty($_POST["firstName"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["birthDate"]) && !empty($_POST["gender"]) && !empty($_POST["division"]) && !empty($_POST["district"])) {
			require 'Registration_Update.php';
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
	<title>Registration | Blood Donors Network</title>
	<meta charset="utf-8">
	<style type="text/css">
		.error{
			color: red;
		}
		.MainContent{
			text-align: center;
			font-family: Harrington;
		}
	</style>
</head>
<body class="MainContent">        
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
       
       <h2>Registration</h2>        
        <div class="inputbox">
        	<label>First Name : </label>
			<input type="text" name="firstName" placeholder="type your first name">
			<span class="error"><?php echo $fnameErr; ?></span>
			<br><br>
		</div>

		<div class="inputbox">
			<label>Last Name : </label>
			<input type="text" name="lastName" placeholder="type your last name">
			<span class="error"><?php echo $lnameErr; ?></span>
			<br><br>
		</div>

		<div class="inputbox">
			<label>Email ID : </label>
			<input type="email" name="email" placeholder="Ex: example@example.com">
			<span class="error"><?php echo $emailErr; ?></span>
			<br><br>
		</div>

		<div class="inputbox">
			<label>Password : </label>
			<input type="password" name="password" title="No limit">
			<span class="error"><?php echo $passwordErr; ?></span>
			<br><br>
	    </div>

	    <div class="inputbox">
			<label>Phone : </label>
			<input type="text" name="phoneNumber" placeholder="type your phone number">
			<span class="error"><?php echo $phoneNumberErr; ?></span>
			<br><br>
	    </div>

	    <div class="inputbox">
			<label>Birth Date : </label>
			<input type="Date" name="birthDate">
			<span class="error"><?php echo $birthDateErr; ?></span>
			<br><br>
	    </div>

	    <div class="inputbox">
			<label>Gender : </label><br />
			<input type="radio" name="gender" value="Male"><label>Male</label>
			<input type="radio" name="gender" value="Female"><label>Female</label>
			<input type="radio" name="gender" value="Other"><label>Other</label>
			<span class="error"><?php echo $genderErr; ?></span>
			<br /><br />
	    </div>

	    <div class="inputbox">
	    	<label>Please select your blood group from below: </label><br />
	    	<select name="bloodGroup">
			  <option value="A+">A+</option>
			  <option value="A-">A-</option>
			  <option value="AB+">AB+</option>
			  <option value="AB-">AB-</option>
			  <option value="B+">B+</option>
			  <option value="B-">B-</option>
			  <option value="O+">O+</option>
			  <option value="O-">O-</option>
			  <span class="error"><?php echo $bloodGroupErr; ?></span>
			</select>
			<br /><br />
	    </div>

	    <div class="inputbox">
	    	<label>Division : </label>
	    	<select name="division">
	    		<option value="Dhaka">Dhaka</option>
	    		<option value="Rajshahi">Rajshahi</option>
	    		<option value="Sylhet">Sylhet</option>
	    		<option value="Chittagang">Chittagang</option>
	    		<option value="Barishal">Barishal</option>
	    		<option value="Khulna">Khulna</option>
	    		<span class="error"><?php echo $divisionNameErr; ?></span>
	    	</select>
	    	<br /><br />
	    </div>

	    <div class="inputbox">
			<label>District : </label>
			<input type="text" name="district" placeholder="type your district name">
			<span class="error"><?php echo $districtNameErr; ?></span>
			<br><br>
	    </div>

	    <div class="inputbox">
			<label>Area : </label>
			<input type="text" name="area" placeholder="type your area name">
			<span class="error"><?php echo $areaNameErr; ?></span>
			<br><br>
	    </div>

		<input type="submit" name="submit" value="Register">
	</form>
	<label>Already have an account. Please </label>
	<a href="/Blood Donors Network/Login.php" style="text-decoration: none; color: green;">Log in</a>
	<label> here.</label>
	<br />
	<label>Go to <a style="text-decoration: none; color: cyan;" href="/Blood Donors Network/Home.php">Home</a></label>
</body>
</html>
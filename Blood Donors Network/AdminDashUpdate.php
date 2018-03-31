<?php
	session_start();

	// if(isset($_SESSION['logged_in']) && $_SESSION['Type']=="Admin"){
	// 	require_once 'GetUserInformation.php';
	// 	$getAdminInfo = GetUserInformation2P("Admin",$_SESSION['EmailID']);
	// 	$st ="";
	// }else{
	// 	if ($_SESSION['Type']=="User") {
	// 		header("location: UserDash.php");
	// 	}else{
	// 		header("location: Login.php");
	// 	}
	// }

	$area1Err = $area2Err = $distanceErr = "";
	$area1Name = $area2Name = $distance = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["area1Name"])){
			$area1Err = "Area1 name is required.";
		}if(empty($_POST["area2Name"])){
			$area2Err = "Area2 name is required.";
		}if(empty($_POST["distance"])){
			$distanceErr = "Distance is required.";
		}
		else
		{
			$area1Name = test_input($_POST["area1Name"]);
			$area2Name = test_input($_POST["area2Name"]);
			$distance = test_input($_POST["distance"]);
		}

		if (!empty($_POST["area1Name"]) && !empty($_POST["area2Name"]) && !empty($_POST["distance"])) {
			require('GetUserInformation.php');
			DistanceVectorTable($_POST['area1Name'], $_POST['area2Name'], $_POST['distance']);
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
	<title>Admin Dash</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

 <body class="box">        
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">       
        <div class="form-group">

        	<div class="col-3">
			<br />


			<a href="/Blood Donors Network/AdminDash.php" class="btn btn-success">                                                        Go To Profile</a>
			<br />
        	<h3>Update distance</h3>


		    <!-- <label for="ex1">col-3</label>
		    <input class="form-control" id="ex1" type="text">
			<br><br> -->

        <!-- <div class="inputbox"> -->
	    	<div class="alert alert-danger">
        	<label for="ex2"><b>Area 1: </b></label>
			<input type="text" name="area1Name" placeholder="Type First Area Name" class="form-control" id="ex2">
			<!-- <span class="alert alert-danger"><?php echo $area1Err; ?></span> -->
			<strong><?php echo $area1Err; ?></strong>
			<br><br>
		<!-- </div> -->
	</div>

	    	<div class="alert alert-danger">
		<!-- <div class="inputbox"> -->
			<label for="ex3">Area 2 : </label>
			<input type="text" name="area2Name" placeholder="type Second Area Name" class="form-control" id="ex3">
			<!-- <span class="alert alert-danger"><?php echo $area2Err; ?></span> -->
			<strong><?php echo $area2Err; ?></strong>
			<br><br>
		<!-- </div> -->
	</div>

	    <!-- <div class="inputbox"> -->
	    	<div class="alert alert-danger">
        	<label for="ex4">Distance: </label>
			<input type="text" name="distance" placeholder="Type Distance" class="form-control" id="ex4">
			
			    <strong><?php echo $distanceErr; ?></strong>
			  </div>
			<!-- <span class="alert alert-danger"><?php echo $distanceErr; ?></span> -->
			<!-- <br><br> -->
		<!-- </div> -->


	    <!-- <div class="inputbox"> -->
			<input type="submit" name="submit" value="Submit" class="btn btn-danger">
			
		<br><br>
		</div>
		</div>
	</form>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
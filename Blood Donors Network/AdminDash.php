<?php
	session_start();

	if(isset($_SESSION['logged_in']) && $_SESSION['Type']=="Admin"){
		echo "Welcome to Admin dash ; demo";
	}else{
		if ($_SESSION['Type']=="User") {
			header("location: UserDash.php");
		}else{
			header("location: Login.php");
		}
	}
?>

<?php
	session_start();

	//ckecking if user exist or not

	if(!empty($_GET['email'])){
		$_SESSION['checkEmail'] = $_GET['email'];
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Demo profile</title>
</head>
<body>
	<h1>Demo</h1>
	<form method="post" action="CheckUser.php">
		email: <?php echo $_SESSION['checkEmail']; ?>
		<input type="submit" name="">
	</form>
	<label>Go to <a href="home.php">home</a></label>
</body>
</html>
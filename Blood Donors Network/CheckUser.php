
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>
	<style type="text/css">
				/*

		RESPONSTABLE 2.0 by jordyvanraaij
		  Designed mobile first!

		If you like this solution, you might also want to check out the 1.0 version:
		  https://gist.github.com/jordyvanraaij/9069194

		*/
		.responstable {
		  margin: 1em 0;
		  width: 100%;
		  overflow: hidden;
		  background: #FFF;
		  color: #024457;
		  border-radius: 10px;
		  border: 1px solid #167F92;
		}
		.responstable tr {
		  border: 1px solid #D9E4E6;
		}
		.responstable tr:nth-child(odd) {
		  background-color: #EAF3F3;
		}
		.responstable th {
		  display: none;
		  border: 1px solid #FFF;
		  background-color: #167F92;
		  color: #FFF;
		  padding: 1em;
		}
		.responstable th:first-child {
		  display: table-cell;
		  text-align: center;
		}
		.responstable th:nth-child(2) {
		  display: table-cell;
		}
		.responstable th:nth-child(2) span {
		  display: none;
		}
		.responstable th:nth-child(2):after {
		  content: attr(data-th);
		}
		@media (min-width: 480px) {
		  .responstable th:nth-child(2) span {
		    display: block;
		  }
		  .responstable th:nth-child(2):after {
		    display: none;
		  }
		}
		.responstable td {
		  display: block;
		  word-wrap: break-word;
		  max-width: 7em;
		}
		.responstable td:first-child {
		  display: table-cell;
		  text-align: center;
		  border-right: 1px solid #D9E4E6;
		}
		@media (min-width: 480px) {
		  .responstable td {
		    border: 1px solid #D9E4E6;
		  }
		}
		.responstable th, .responstable td {
		  text-align: left;
		  margin: .5em 1em;
		}
		@media (min-width: 480px) {
		  .responstable th, .responstable td {
		    display: table-cell;
		    padding: 1em;
		  }
		}

		body {
		  padding: 0 2em;
		  font-family: Arial, sans-serif;
		  color: #024457;
		  background: #f2f2f2;
		}

		h1 {
		  font-family: Verdana;
		  font-weight: normal;
		  color: #024457;
		}
		h1 span {
		  color: #167F92;
		}
	</style>
</head>
<body>
	<fieldset>
		<legend>Donar Profile</legend>
		<form method="post">
			<table class="responstable">
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
					<td>Division <?php echo $row['Division']; ?>
					<br />District <?php echo $row['District']; ?>
					<br />Area <?php echo $row['Area']; ?></td>
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
				<tr>
					<td></td>
					<td></td>
					<td>Go to <a href="home.php">donar list</a></td>
				</tr>
			</table>
		</form>
	</fieldset>
</body>
</html>
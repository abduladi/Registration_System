<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div id="content">
	<h2>Welcome to my Registration System</h2>
	<?php
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		
		echo 'Welcome, you are '. '<strong>'. $username . '</strong>' . '<span> <a href="logout.php">logout</a></span>';
	}
	else {
		header('location:login.php');
	}
?>
</div>
</body>
</html>
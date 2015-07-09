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
		session_destroy();
		echo 'You have been logged out, Please '. '<a href="login.php">login</a>';
	}
	else{
		echo 'You cannot log out because you are not logged in';
	}
?>
</div>
</body>
</html>
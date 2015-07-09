<?php
session_start();
$db_name = "demo";
$db_user = "root";
$db_pass = "";
$db_tab = "users";
$db_host = "localhost";
$con = mysqli_connect($db_host, $db_user, $db_pass)
		or die(mysqli_error());
$select = mysqli_select_db($con, $db_name)
			or die(mysqli_error());
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div id="content">
<?php
	$error = ""; //declare variable that will hold form error.
	//If the registration form is submitted
if(isset($_POST['login'])){
	//declare variables and store form date in them.
	$username = mysql_real_escape_string($_POST['username']); 
	$password = md5(mysql_real_escape_string($_POST['passwd']));
	
	$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	$qry = mysqli_query($con, $query);
	$query2 = mysqli_num_rows($qry);
	if($query2 > 0){
			$_SESSION['username'] = $username;
			$loggedIn = true;
			header("location:member.php");
	}
	else{
		$error = "Invalid Username/Password";
	}
}
?>	
<h2>Welcome to my Registration System</h2>
<p>Login below or <a href="register.php">click here</a> to Register.</p>
<span class="error"><?php echo $error;?></span>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="login">
	<label for="username">Username:</label>
    	<input name="username" type="text" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">
	<label for="password">Password:</label>
    	<input name="passwd" type="password" value="<?php if(isset($_POST['passwd'])) echo $_POST['passwd'];?>">
    	<input name="login" type="submit" value="Login">
</form>
</div>
</body>
</html>
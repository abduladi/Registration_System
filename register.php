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

	//declare variable that will hold(True or false) if our form has error
	$noError = true;
		
	//declare variables that will hold actual error for each fields
	$userError = $passError = $locError = "";
		
	//declare variables for our form data
	$username = $password = $location = $gender = "";
	$userTaken = ""; //variable that will hold username status.
	
	//If the registration form is submitted
	if(isset($_POST['register'])){
		
		//validate username
		if(empty($_POST['username'])){
			$noError = false;
			$userError = "Please Enter Username";
		}
		else {
			$username = mysql_real_escape_string($_POST['username']);
		}
		//validate password
		if(empty($_POST['passwd'])){
			$noError = false;
			$passError = "Please Enter Password";
		}
		else{
			$password = md5(mysql_real_escape_string($_POST['passwd']));
		}
		//validate location
		if(empty($_POST['location'])){
			$noError = false;
			$locError = "Please Enter Location";
		}
		else {
			$location = mysql_real_escape_string($_POST['location']);
		}
		$gender = mysql_real_escape_string($_POST['gender']);
	//If our form has no errors, insert form data into our database
		if($noError){
			$query = "SELECT username FROM users WHERE username = '$username'";
			$qry = mysqli_query($con, $query);
			$query2 = mysqli_num_rows($qry);
			//check to see if the username is already in use, if its in use prompt the user to choose another one, else go on inserting the details.
			if($query2 > 0){
					$userTaken = 'Username already taken, Please choose another one';
				}
			else{
				$insert = "INSERT INTO users(username, password, location, gender) VALUES('$username', '$password', '$location', '$gender')";
				$ins = mysqli_query($con, $insert);
				if($ins){
					header('location:login.php');
				}
				else {
					die();
				}
			}
		}
}
?>
<h2>Welcome to my Registration System</h2>
<p>Kindly fill the form below to Register</p>
<p class="error"><?php echo $userTaken;?></p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    	<label for="username">Username:</label>
    	<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $username;?>"><span class="error"><?php echo $userError;?></span>
    	<label for="password">Password:</label>
    	<input type="password" name="passwd" value="<?php if(isset($_POST['passwd'])) echo $password;?>"><span class="error"><?php echo $passError;?></span>
		<label for="location">Location:</label>
    	<input type="text" name="location" value="<?php if(isset($_POST['location'])) echo $location;?>"><span class="error"><?php echo $locError;?></span>
		<label for="select">Gender:</label>
		<select name="gender" id="select">
		  <option value="male">Male</option>
		  <option value="female">Female</option>
	    </select>
   	  <input type="submit" name="register" value="Register">
  </form>
<p>Already a member <a href="login.php">click here</a> to login </p>
</div>
</body>
</html>

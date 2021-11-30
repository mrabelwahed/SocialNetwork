
<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//db connection
$con = mysqli_connect("localhost","root","","social");
if(mysqli_connect_errno()){
	echo "failed to connect".mysqli_connect_errno();
}

//variables 
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date="";
$error_array="";


if (isset($_POST["reg_button"])) {

// first name
$fname = strip_tags($_POST["reg_fname"]);
$fname = str_replace(' ', '', $fname);
$fname = ucfirst($fname);

// last name
$lname = strip_tags($_POST["reg_lname"]);
$lname = str_replace(' ', '', $lname);
$lname = ucfirst($lname);

// email
$em = strip_tags($_POST["reg_email"]);
$em = str_replace(' ', '', $em);
$em = ucfirst($em);

// email2
$em2 = strip_tags($_POST["reg_email2"]);
$em2 = str_replace(' ', '', $em2);
$em2 = ucfirst($em2);

// password
$password = strip_tags($_POST["reg_password"]);

// password2
$password2 = strip_tags($_POST["reg_password2"]);

//date
$date = date("Y-m-d");

//check if emails matched

if ($em == $em2) {
	if(filter_var($em, FILTER_VALIDATE_EMAIL)){

		$em = filter_var($em, FILTER_VALIDATE_EMAIL);
		// check if email is used
		$e_check = mysqli_query($con,"SELECT email FROM users WHERE email='$em'");
		$num_rows = mysqli_num_rows($e_check);
		if ($num_rows > 0) {
		   echo "Email already in use<br>";
		}
	}
	else
		echo "Invalid formats<br>";
}else{
	echo "Emails do not match<br>";
}

// validate first name

if (strlen($fname) >25 || strlen($fname) <2) {
	echo "Your first name must between 2 and 25 <br>";
}

// validate last name

if (strlen($lname) >25 || strlen($lname) <2) {
	echo "Your last name must between 2 and 25<br>";
}

// validate passwords
if ($password != $password2) {
	echo "Your passeord do not match<br>";
}else{
	if (preg_match('/[^A-Za-z0-9]/', $password)) {
		echo "your password can contain only english alphabets abd numbers <br>";
	}
}

if (strlen($password) > 30 || strlen($password2) < 5) {
	echo "Your password must between 5 and 30 characters <br>";
}


}




 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

 <form accept="register.php" method="POST">
 	<input type="text" name="reg_fname" placeholder="First Name" required><br>
 	<input type="text" name="reg_lname" placeholder="Second Name" required><br>
 	<input type="email" name="reg_email" placeholder="Email" required><br>
 	<input type="email" name="reg_email2" placeholder="Confirm Email" required><br>
 	<input type="password" name="reg_password" placeholder="Password" required><br>
 	<input type="password" name="reg_password2" placeholder="Confirm Name" required><br>
 	<input type="submit" name="reg_button" placeholder="submit">
 </form>



</body>
</html>

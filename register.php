
<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
	if(filter_var($em, FILTER_VALIDATE_EMAIL))
		$em = filter_var($em, FILTER_VALIDATE_EMAIL);
	else
		echo "Invalid formats";
}else{
	echo "Emails do not match";
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

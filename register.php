
<?php
session_start();
//for debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//============================================
//db connection
$con = mysqli_connect("localhost", "root", "", "social");
if (mysqli_connect_errno()) {
    echo "failed to connect" . mysqli_connect_errno();
}

//variables
$fname       = "";
$lname       = "";
$em          = "";
$em2         = "";
$password    = "";
$password2   = "";
$date        = "";
$error_array = array();

if (isset($_POST["reg_button"])) {

// first name
    $fname                 = strip_tags($_POST["reg_fname"]);
    $fname                 = str_replace(' ', '', $fname);
    $fname                 = ucfirst($fname);
    $_SESSION['reg_fname'] = $fname;

// last name
    $lname                 = strip_tags($_POST["reg_lname"]);
    $lname                 = str_replace(' ', '', $lname);
    $lname                 = ucfirst($lname);
    $_SESSION['reg_lname'] = $lname;

// email
    $em                    = strip_tags($_POST["reg_email"]);
    $em                    = str_replace(' ', '', $em);
    $em                    = ucfirst($em);
    $_SESSION['reg_email'] = $em;

// email2
    $em2                    = strip_tags($_POST["reg_email2"]);
    $em2                    = str_replace(' ', '', $em2);
    $em2                    = ucfirst($em2);
    $_SESSION['reg_email2'] = $em2;

// password
    $password = strip_tags($_POST["reg_password"]);

// password2
    $password2 = strip_tags($_POST["reg_password2"]);

//date
    $date = date("Y-m-d");

//check if emails matched
    if ($em == $em2) {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {

            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            // check if email is used
            $e_check  = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows > 0) {
                array_push($error_array, "Email already in use<br>");
            }
        } else {
            array_push($error_array, "Invalid formats<br>");
        }

    } else {
        array_push($error_array, "Emails do not match<br>");
    }

// validate first name

    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must between 2 and 25 <br>");
    }

// validate last name

    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must between 2 and 25<br>");
    }

// validate passwords
    if ($password != $password2) {
        array_push($error_array, "Your password do not match<br>");
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "your password can contain only english alphabets and numbers <br>");
        }
    }

    if (strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Your password must between 5 and 30 characters <br>");
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
    <input type="text" name="reg_fname" placeholder="First Name"
     value = "<?php
if (isset($_SESSION['reg_fname'])) {
    echo $_SESSION['reg_fname'];
}
?>"
     required><br>
     <?php if (in_array("Your first name must between 2 and 25 <br>", $error_array)) {
    echo "Your first name must between 2 and 25 <br>";
}?>

    <input type="text" name="reg_lname" placeholder="Second Name"
  value = "<?php
if (isset($_SESSION['reg_lname'])) {
    echo $_SESSION['reg_lname'];
}
?>"
    required><br>
    <?php if (in_array("Your last name must between 2 and 25<br>", $error_array)) {
    echo "Your last name must between 2 and 25<br>";
}?>

    <input type="email" name="reg_email" placeholder="Email"
     value = "<?php
if (isset($_SESSION['reg_email'])) {
    echo $_SESSION['reg_email'];
}
?>"
     required><br>
     <?php
if (in_array("Email already in use<br>", $error_array)) {
    echo "Email already in use<br>";
} elseif (in_array("Invalid formats<br>", $error_array)) {
    echo "Invalid formats<br>";
} elseif (in_array("Emails do not match<br>", $error_array)) {
    echo "Emails do not match<br>";
}

?>
    <input type="email" name="reg_email2" placeholder="Confirm Email"
     value = "<?php
if (isset($_SESSION['reg_email2'])) {
    echo $_SESSION['reg_email2'];
}
?>"required><br>
    <input type="password" name="reg_password" placeholder="Password" required><br>
    <input type="password" name="reg_password2" placeholder="Confirm Name" required><br>
    <?php
if (in_array("Your password do not match<br>", $error_array)) {
    echo "Your password do not match<br>";
} elseif (in_array("Your password must between 5 and 30 characters <br>", $error_array)) {
    echo "Your password must between 5 and 30 characters <br>";
} elseif (in_array("your password can contain only english alphabets and numbers <br>", $error_array)) {
    echo "your password can contain only english alphabets and numbers <br>";
}

?>
    <input type="submit" name="reg_button" placeholder="submit">
 </form>



</body>
</html>

<?php

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

    //create encrypted password
    $password = md5($password);

    //create unique username
    if (empty($error_array)) {
        $username             = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users where username='$username'");
        $i                    = 0;
        while (mysqli_num_rows($check_username_query) != 0) {
            $i++;
            $username             = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users where username='$username'");
        }

        // profile pic
        $rand = rand(1, 2);
        if ($rand == 1) {
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        } else if ($rand == 2) {
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        }

        //insert new user in users table

        $query = mysqli_query($con, "INSERT INTO users VALUES(NULL,'$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

        array_push($error_array, "<span style='color:#14c800'>  you are all set , pleas login </span><br>");
        //clear session variable after submitting new user
        $_SESSION['reg_fname']  = "";
        $_SESSION['reg_lname']  = "";
        $_SESSION['reg_email']  = "";
        $_SESSION['reg_email2'] = "";

    }

}

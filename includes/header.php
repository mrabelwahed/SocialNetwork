<?php
require 'config/config.php';
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userDetails = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($userDetails);
} else
    header("Location: register.php");
?>

<html>

<head>
    <title>Welcome to Social APP</title>
    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <div class="top-bar">
        <div class="logo">
            <a href="index.php">Social APP</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn; ?>">
                <?php echo $user['first_name']; ?>
            </a>


            <a href="index.php">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a href="#">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a href="#">
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <a href="#">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a href="#">
                <i class="fa fa-cog fa-lg"></i>
            </a>
        </nav>
    </div>
    <div class="wrapper">
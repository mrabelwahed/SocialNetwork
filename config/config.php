<?php

ob_start();
session_start();
$timezone = date_default_timezone_set("Africa/Cairo");

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

<?php

if (isset($_POST['log_button'])) {
    $email                 = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $password              = md5($_POST['log_password']);
    $_SESSION['log_email'] = $email;
    // check if this user existed

    $check_user_query  = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_user_query);
    if ($check_login_query == 1) {
        $row                  = mysqli_fetch_array($check_user_query);
        $username             = $row['username'];
        $_SESSION['username'] = $username;

        //check if user account is closed
        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
        if (mysqli_num_rows($user_closed_query) == 1) {
            $reopen_closed_account = mysqli_query($con, "UPDATE users SET user_closed ='no' WHERE email='$email'");
        }

        header("Location: index.php"); // redirect to index page if log went successfully
        exit();
    } else {
        array_push($error_array, "Your email or password is not correct <br>");
    }
}

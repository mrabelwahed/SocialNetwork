<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>

    <div class="wrapper">

        <div class="login_box">
            <div class="login_header">
                <h1>SocialApp</h1>
                Login or Signup below
            </div>
            <br>
            <div id="first">
                <form action="register.php" method="POST">
                    <input type="text" name="log_email" placeholder="Email Address" value="<?php
                                                                                            if (isset($_SESSION['log_email'])) {
                                                                                                echo $_SESSION['log_email'];
                                                                                            }
                                                                                            ?>" required><br>
                    <input type="text" name="log_password" placeholder="Password" required><br>
                    <?php
                    if (in_array("Your email or password is not correct <br>", $error_array)) {
                        echo "Your email or password is not correct <br>";
                    }
                    ?>
                    <input type="submit" name="log_button" value="Login">
                    <br>

                    <a href="#" id="signup" class="signup">Don't have account? Register here!</a>
                </form>

            </div>
            <br>
            <div id="second">

                <form accept="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                                                                                        if (isset($_SESSION['reg_fname'])) {
                                                                                            echo $_SESSION['reg_fname'];
                                                                                        }
                                                                                        ?>" required><br>
                    <?php if (in_array("Your first name must between 2 and 25 <br>", $error_array)) {
                        echo "Your first name must between 2 and 25 <br>";
                    } ?>

                    <input type="text" name="reg_lname" placeholder="Second Name" value="<?php
                                                                                            if (isset($_SESSION['reg_lname'])) {
                                                                                                echo $_SESSION['reg_lname'];
                                                                                            }
                                                                                            ?>" required><br>
                    <?php if (in_array("Your last name must between 2 and 25<br>", $error_array)) {
                        echo "Your last name must between 2 and 25<br>";
                    } ?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php
                                                                                    if (isset($_SESSION['reg_email'])) {
                                                                                        echo $_SESSION['reg_email'];
                                                                                    }
                                                                                    ?>" required><br>
                    <?php
                    if (in_array("Email already in use<br>", $error_array)) {
                        echo "Email already in use<br>";
                    } elseif (in_array("Invalid formats<br>", $error_array)) {
                        echo "Invalid formats<br>";
                    } elseif (in_array("Emails do not match<br>", $error_array)) {
                        echo "Emails do not match<br>";
                    }

                    ?>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                                                                                                if (isset($_SESSION['reg_email2'])) {
                                                                                                    echo $_SESSION['reg_email2'];
                                                                                                }
                                                                                                ?>" required><br>
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

                    <?php if (in_array("<span style='color:#14c800'>  you are all set , pleas login </span><br>", $error_array)) {
                        echo "<span style='color:#14c800'>  you are all set , pleas login </span><br>";
                    } ?>
                    <br>
                    <a href="#" id="signin" class="signin">Already have account? Register here!</a>
                </form>
            </div>
        </div>

    </div>

</body>

</html>
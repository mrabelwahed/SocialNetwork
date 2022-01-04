<?php
include 'includes/header.php';
//session_destroy(); //destroy session once refresh the page 

?>

<div class="wrapper">
    <div class=" user_details column">
        <a href="<?php echo $userLoggedIn; ?>">
            <img src="<?php echo $user['profile_pic'] ?>">
        </a>

        <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>">
                <?php
                echo $user['first_name'] . " " . $user['last_name'] . "<br>";
                ?>
            </a>
            <?php
            echo "Posts: " . $user['num_posts'] . "<br>";
            echo "Likes: " . $user['num_likes'] . "<br>";

            ?>
        </div>

    </div>
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say"></textarea>
            <input type="submit" id="post_button" name="post" value="Post">
            <hr>
        </form>
    </div>

</div>

</div>

</body>

</html>
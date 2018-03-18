<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = mysqli_real_escape_string($conn, $_POST['email']);
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['user_pwd']) ) {

        $_SESSION['email'] = $user['user_email'];
        $_SESSION['first_name'] = $user['user_first'];
        $_SESSION['last_name'] = $user['user_last'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: ../../application/view/monitor.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
$last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = password_hash($password, PASSWORD_BCRYPT);
$hash = mysqli_real_escape_string($conn, md5( rand(0,1000) ) );

// Check if user with that email already exists
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $_SESSION['message'] = 'User with this email already exists!';
    echo "<script>location='error.php'</script>";

}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (user_first, user_last, user_email, user_pwd, hash) "
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

    // Add user to the database
    if (mysqli_query($conn, $sql)) {

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)


        $verify = $hash;
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'example@gmail.com';                 // SMTP username
            $mail->Password = 'password';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('example@gmail.com', 'Mailer');
            $mail->addAddress($_POST['email']);     // Add a recipient
          //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Account Verification';
            $mail->Body    = 'Thank you for signing up!
                            Please click this link to activate your account: https://ktdemo.000webhostapp.com/fabsystem/helper/loginsystem/verify.php?email='.$email.'&hash='.$verify;
            $mail->send();
            echo "<script>location='profile.php'</script>";
      }
      catch (Exception $e){ }
    }
      else {
        $_SESSION['message'] = 'Registration failed!';
        echo "<script>location='error.php'</script>";

    }

}

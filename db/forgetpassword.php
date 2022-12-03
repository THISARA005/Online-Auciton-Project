<?php

include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token, $text, $page)
{
    require  '../assets/mailer/Exception.php';
    require  '../assets/mailer/PHPMailer.php';
    require  '../assets/mailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'systemeauction@gmail.com';                     //SMTP username
        $mail->Password   = 'zabdhncbbwobzini';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('systemeauction@gmail.com', 'Eauction System');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "{$text} from Eauction";
        $mail->Body    = "We got a {$text} request from you to {$text}!</b>
        Click the link below to {$text}<br>
        <a href='http://localhost/MarqueBeyond/$page?email=$email&reset_token=$reset_token'>$text</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send_reset_link'])) {
    $email = $text = $page = '';
    if (isset($_POST['email_stat'])) {
        $email = $_POST['email_stat'];
        $text = 'Verify Email';
        $page = 'verification.php';
    } else {
        $email = $_POST['email'];
        $text = 'Reset Password';
        $page = 'password_update.php';
    }
    $resetQ = mysqli_query($conn, "SELECT email FROM `users` WHERE `email` = '$email'");
    if ($resetQ) {
        if (mysqli_num_rows($resetQ) == 1) {
            $resetToken = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Colombo');
            $date = date('Y-m-d');
            $query = mysqli_query($conn, "UPDATE `users` SET `resettoken`='$resetToken',`resettokenexpire`='$date' WHERE `email` = '$email'");
            if ($query && sendMail($email, $resetToken, $text, $page)) {
                echo "<script>
                alert('{$text} link has been send to your email');
                window.location.href='{$hostname}';
            </script>";
            } else {
                echo "<script>
        alert('Server Down! Please try later');
        window.location.href='{$hostname}';
    </script>";
            }
        } else {
            echo "<script>
        alert('Please enter correct email');
        window.location.href='{$hostname}';
    </script>";
        }
    } else {
        echo "<script>
        alert('something went wrong');
        window.location.href='{$hostname}';
    </script>";
    }
}

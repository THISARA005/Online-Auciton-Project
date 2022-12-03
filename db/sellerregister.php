<?php
$secompimg_name = $sepimg_name = '';
$seError = '';
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
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
        $mail->Subject = 'Email Verification Link from Eauction';
        $mail->Body    = "Congratulation You have successfully entered the information. Please Verify Your Email!</b>
        Click the link below to verify email<br>
        <a href='http://localhost/MarqueBeyond/verification.php?email=$email&reset_token=$reset_token'>Verify Email</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


if (isset($_POST['verification_link'])) {

    $seemail = mysqli_real_escape_string($conn, $_POST['seemail']);
    $seemail = strtolower($seemail);

    $sefname = mysqli_real_escape_string($conn, $_POST['sefname']);
    $selname = mysqli_real_escape_string($conn, $_POST['selname']);
    $sepass = sha1($_POST['sepass']);
    $secompname = mysqli_real_escape_string($conn, $_POST['secompname']);
    $secompreg = mysqli_real_escape_string($conn, $_POST['secompreg']);
    $secontact = mysqli_real_escape_string($conn, $_POST['secontact']);
    $seagremnt = $_POST['seagremnt'];

    $user = "seller";
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d');

    if (mysqli_num_rows(mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$seemail'")) > 0) {
        $seError .= "<br> Following email is already exits";
    }
    if (!mysqli_num_rows(mysqli_query($conn, "SELECT comp_nam FROM company WHERE comp_nam = '$secompname'")) === 0) {
        $seError .= "<br> This <b>{$secompname}</b> Company Name is already exists.";
    } else {
        $seError = '';
    }
    if (empty($seError) === false) {
        echo "<div class='error'><ul>
        <li>$seError</li><br>
        </ul></div>";
        die();
    }

    if (isset($_FILES['seprofile[]']) && isset($_FILES['secompimg[]'])) {
        $sepimg_name = $_FILES['seprofile[]']['name'];
        $sepimg_type = pathinfo($sepimg_name, PATHINFO_EXTENSION);
        $sepimg_name = uniqid().$date.'.'.$sepimg_type;
        $sepimg_tmpname = $_FILES['seprofile[]']['tmp_name'];

        $secompimg_name = $_FILES['secompimg[]']['name'];
        $secompimg_type = pathinfo($secompimg_name, PATHINFO_EXTENSION);
        $secompimg_name = uniqid().$date.'.'.$secompimg_type;
        $secompimg_tmpname = $_FILES['secompimg[]']['tmp_name'];
       
        move_uploaded_file($sepimg_tmpname, $USER_IN_IMAGE_PATH . $sepimg_name) or die('img not uploaded');
        move_uploaded_file($secompimg_tmpname, $COMP_IN_IMAGE_PATH . $secompimg_name) or die('img not uploaded');
    }
    


    mysqli_query($conn, "INSERT INTO `company` (`comp_nam`, `comp_reg`, `comp_img`) VALUES ('$secompname' , '$secompreg' , '$secompimg_name')");

    $query = mysqli_query($conn, "SELECT comp_id FROM company WHERE comp_nam = '$secompname'");
    $rows = mysqli_fetch_assoc($query);
    if($rows){
        echo "slxjnd";
    }
    
    $compid = $rows['comp_id'];
    
    
    
    $insertSeUser = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `pasword`, `user_type`, `comp_id`, `address_id`, `contact`,`reg_date`, `user_img`, `agrement`) VALUES ('$sefname' , '$selname' , '$seemail' , '$sepass' , '$user' , $compid, NULL , '$secontact', '$date' , '$sepimg_name', $seagremnt)" or die('seller registration Query Failed');
    $seUser = mysqli_query($conn, $insertSeUser);
    if ($seUser) {
        $resetToken = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $query = mysqli_query($conn, "UPDATE `users` SET `resettoken`='$resetToken',`resettokenexpire`='$date' WHERE `email` = '$seemail'");
        if ($query && Mail($seemail, $resetToken)) {
            echo "<div class='link-popup'>
            <h2>Verify Your Email</h2>
            <p>Verification link has been send to your email</p>
            <button><a href='{$hostname}'>Go Back</a></button>
        </div>";
        } else {
            echo "<script>
        alert('Server Down! Please try later');
        window.location.href='http://localhost/MyFolder/MarqueBeyond/MarqueBeyond/admin';
    </script>";
        }
    }
} else {
    echo "<script>
        window.location.href='{$hostname}';
    </script>";
}
?>

<style>
    .link-popup {
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(196, 196, 196, 0.65);
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        align-content: center;
    }

    .link-popup h2 {
        font-size: 3rem;
    }

    .link-popup p {
        font-size: 1.5rem;
    }

    .link-popup button {
        border: none;
        outline: none;
    }

    .link-popup button a {
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: bold;
        color: #f9aa19;
        display: block;
        text-decoration: none;
    }
</style>
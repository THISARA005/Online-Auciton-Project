<?php
session_start();
require 'db/config.php';
if(isset($_SESSION['user']) || isset($_SESSION['ad_userid'])){
    echo "
    <script>
        window.location.href='{$hostname}';
    </script>
    ";
}
$error = '';
if (isset($_POST['userlogin'])) {
    $useremail = mysqli_real_escape_string($conn, $_POST['email']);
    $userpass = mysqli_real_escape_string($conn, sha1($_POST['password']));
    $selectUser = "SELECT `user_id`, `email`, `pasword`, `status` , `user_type` FROM `users` WHERE `email` = '{$useremail}' AND `pasword` = '{$userpass}'" or die("Query failed");
    $user = mysqli_query($conn, $selectUser);
    if (mysqli_num_rows($user) > 0) {
        $urow = mysqli_fetch_assoc($user);
        if($urow['status'] === '1') {
            if ($_POST['password']) {
                $_SESSION['status'] = true;
                $_SESSION['user_email'] = $urow['email'];
                $_SESSION['user_pas'] = $urow['pasword'];
                $user_type = $urow['user_type'];
                if ($user_type == 'seller') {
                    $_SESSION['se_userid'] = $urow['user_id'];
                    $_SESSION['user'] = $urow['user_id'];
                    echo "
                    <script>
                        window.location.href='{$hostname}seller/overview.php';
                    </script>
                    ";
                } elseif ($user_type == 'buyer') {
                    $_SESSION['bu_userid'] = $urow['user_id'];
                    $_SESSION['user'] = $urow['user_id'];
                    echo "
                    <script>
                        window.location.href='{$hostname}buyer/overview.php';
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                        window.location.href='{$hostname}index.php';
                    </script>
                    ";
                }
            }
        }
    } else {
        $error = "<small style='color : red'>Please enter correct Login Details</small>";
    }
mysqli_close($conn);
}
?>
<link rel="stylesheet" href="css/login.css">
<style>
    .login-form-cont {
        display: flex;
    }
</style>
<div class="login-form-cont" id="popup-login">
    <div class="popup-login">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h2>
                <span>User Login</span>
            </h2>
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" class="login-btn" name="userlogin">Login</button>
        </form>
        <?php echo $error; ?>
        <div class="forget-btn">
            <button type="button" onclick="forgetPopup()">Forget Password ?</button>
        </div>
    </div>
</div>
<div class="login-form-cont" id="forget-login">
    <div class="popup-login forget">
        <form action="db/forgetpassword.php" method="POST">
            <h2>
                <span>Reset Password</span>
            </h2>
            <input type="text" name="email" placeholder="Enter your email">
            <button type="submit" class="login-btn" name="send_reset_link">Send</button>
        </form>
        <div class="forget-btn">
            <button type="button" onclick=" loginPopup()">Back To Signin</button>
        </div>
    </div>
</div>
<script>
    document.getElementById('forget-login').style.display = 'none';

    function forgetPopup() {
        document.getElementById('popup-login').style.display = 'none';
        document.getElementById('forget-login').style.display = 'flex';
    }

    function loginPopup() {
        document.getElementById('popup-login').style.display = 'flex';
        document.getElementById('forget-login').style.display = 'none';
    }
</script>
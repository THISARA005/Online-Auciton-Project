<?php include './components/header.php' ?>

<?php

if (isset($_GET['email']) && isset($_GET['reset_token'])) {
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d');
    $query = mysqli_query($conn, "SELECT email FROM `users` WHERE `email` = '$_GET[email]' AND `resettoken` = '$_GET[reset_token]' AND `resettokenexpire`='$date'");
    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            echo "
            <div class='update-pass-cont'>
            <div class='update-pass'>
                <form method='POST'>
                    <h2>
                        <span>Reset Password</span>
                    </h2>
                    <input type='password' name='password' placeholder='Enter your New Password'>
                    <button type='submit' class='login-btn' name='updatepassword'>Update</button>
                    <input type='hidden' name='email' value='$_GET[email]'>
                </form> 
            </div>
        </div>
            ";
        } else {
            echo "<script>
        alert('Invalid or Link time is Expire');
        window.location.href='{$hostname}';
    </script>";
        }
    } else {
        echo "<script>
    alert('Server Down! Please try later');
    window.location.href='{$hostname}';
</script>";
    }

    if (isset($_POST['updatepassword'])) {
        $password = sha1($_POST['password']);
        $updateQ = mysqli_query($conn, "UPDATE `users` SET `pasword`='$password',`resettoken`= NULL,`resettokenexpire`= NULL , `status` = 1 WHERE `email` = '$_POST[email]'");
        if ($updateQ) {
            echo "<script>
    alert('Your Password update Successfully');
    window.location.href='{$hostname}';
</script>";
        } else {
            echo "<script>
    alert('Server Down! Please try later');
    window.location.href='{$hostname}';
</script>";
        }
    }
} else {
    echo " <script>
    window.location.href='{$hostname}';
</script>";
} 
mysqli_close($conn);
?>
<?php include './components/footer.php' ?>
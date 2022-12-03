<?php
require_once('db/config.php');
session_start();
if(isset($_SESSION['user'])){
    header("Location: {$hostname}");
}
if (isset($_SESSION['ad_userid'])) {
    header("Location: {$hostname}overview.php");
}
?>
<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="align">
            <div class="logo">
                <img src="<?php echo $LOGO_IMAGE_PATH ?>" alt="Logo" width="100px" height="50px">
            </div>
            <h3 class="heading">Admin Login</h3>
            <?php
            if (isset($_POST['adlogin'])) {
                include './db/config.php';
                $ademail = mysqli_real_escape_string($conn, $_POST['email']);
                $adpass = mysqli_real_escape_string($conn, sha1($_POST['password']));
                $selectad = "SELECT `ad_id`, `ad_email`, `ad_password` FROM `administrate` WHERE `ad_email` = '{$ademail}' AND `ad_password` = '{$adpass}'" or die("Query failed");
                $ad = mysqli_query($conn, $selectad);
                if (mysqli_num_rows($ad) > 0) {
                $ad = mysqli_fetch_assoc($ad);
                    if ($_POST['password']) {
                        session_start();
                        $_SESSION['ad_userid'] = $ad['ad_id'];
                        header("Location: {$hostname}overview.php");
                    } else {
                        echo "<h3 style='color : red'>Please enter correct Login Details</h3>";
                    }
                } else {
                    echo "<h3 style='color : red'>Please enter correct Login Details</h3>";
                }
            } mysqli_close($conn);?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <input type="submit" name="adlogin" class="btn" value="login">
            </form>
            
        </div>
    </div>
</body>

</html>
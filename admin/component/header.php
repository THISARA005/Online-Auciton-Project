<?php
require_once('db/config.php');
session_start();
if (!isset($_SESSION['ad_userid'])) {
    header("Location: {$hostname}");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- Css File -->
    <?php include 'css.php'; ?>
    <!-- JS File -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="heading">
            <h3>Admin</h3>
        </div>
        <script src="assets/js/dropdown.js"></script>
        <?php $adimgQ = mysqli_query($conn, "SELECT  `ad_firstname`, `ad_lastname`, `ad_img` FROM `administrate` WHERE `ad_id` = '$_SESSION[ad_userid]'");
        $adimg = mysqli_fetch_assoc($adimgQ);
        ?>
        <div class="user">
            <div class="avatar" id="user" onclick="menuProfile()">
                <img src="<?php echo $ADMIN_IMAGE_PATH . $adimg['ad_img'] ?>" alt="profile">
            </div>
            <span onclick="menuProfile()"><?php echo $adimg['ad_firstname'] . ' ' . $adimg['ad_lastname']; ?></span>
            <div class="profile">
                <ul class="pro-drop" id="profile">
                    <li><a href="<?php echo $mainhost ?>">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="aside">
            <ul>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "overview.php") echo 'class="active"'; ?> href="overview.php">Overview</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "schedule.php") echo 'class="active"'; ?> href="schedule.php">Schedule Auction</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "seller_report.php") echo 'class="active"'; ?> href="seller_report.php">Seller Report</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "buyer_report.php") echo 'class="active"'; ?> href="buyer_report.php">Buyer Report</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "message.php") echo 'class="active"'; ?> href="message.php">Messages</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "setting.php") echo 'class="active"'; ?> href="setting.php">Setting</a></li>
            </ul>
        </div>
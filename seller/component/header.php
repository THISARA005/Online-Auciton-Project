<?php
require_once('../db/config.php');
session_start();
if (!isset($_SESSION['se_userid'])) {
    header("Location: {$hostname}login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- Css Files -->
    <?php include 'css.php'; ?>

    <!-- Js Files -->
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/dropdown.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="header">
        <div class="heading">
            <h3>Seller</h3>
        </div>
        <?php $userid = $_SESSION['se_userid'];
        $userimgQ = mysqli_query($conn, "SELECT  `first_name`, `last_name`, `user_img` FROM users WHERE `user_id` = $userid");
        $userimg = mysqli_fetch_assoc($userimgQ);
        ?>
        <div class="user">
            <div class="avatar" id="user" onclick="menuProfile()">
                <img src="<?php echo $USER_IN_IMAGE_PATH.$userimg['user_img'] ?>" alt="profile">
            </div>
            <span onclick="menuProfile()"><?php echo $userimg['first_name'] . ' ' . $userimg['last_name']  ?></span>
            <div class="profile">
                <ul class="pro-drop" id="profile">
                    <li><a href="<?php echo $hostname ?>">Home</a></li>
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
                <li class="drop"><a <?php if (basename($_SERVER['PHP_SELF']) == "host-auction.php") echo 'class="active"'; ?> href="host-auction.php">Host Auction</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "ongoing-auction.php") echo 'class="active"'; ?> href="ongoing-auction.php">Ongoing Auction</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "past-auction.php") echo 'class="active"'; ?> href="past-auction.php">Past Auction</a></li>
                <li><a <?php if (basename($_SERVER['PHP_SELF']) == "setting.php") echo 'class="active"'; ?> href="setting.php">Setting</a></li>
            </ul>
        </div>
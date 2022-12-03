<?php include './db/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction</title>

    <!-- Favicon -->
    <link type="image/png" sizes="96x96" rel="icon" href="assets/img/icons8-car-96.png">

    <!-- Import Css File -->
    <?php include 'css.php' ?>

    <!-- Import Js File -->
    <?php include 'js.php' ?>

    <!-- -- --- Font Awesome 5.15.4 Version ----- -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
</head>

<body>
    <div class="nav-top">
        <!-- Social Icons -->
        <ul class="top-social">
            <li><a href=""><i class="fab fa-facebook"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            <li><a href=""><i class="fab fa-instagram"></i></a></li>
            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
        </ul>
        <!-- Number -->
        <div class="top-nmbr">
            <span class="nmbr-text">Call Us : </span>
            <span class="nmbr">
                <a href="">+94-11-234-5678</a>
            </span>
        </div>
    </div>

    <!-- Menu Section Start-->
    <div class="menu-cont">
        <div class="menu">
            <div href="" class="brand">
                <!-- Company LOGO HERE -->
                <span class="logo"><i class="fas fa-car"></i></span>
                <h2 class=""><a href="">E-Auction</a> <br><span>Auction At Your Finger Tips</span></h2>
            </div>
            <div class="menu-item" id="navmenu">
                <span id="resmenu"><i class="fas fa-bars"></i></span>
                <ul class="" id="resuldis">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li class="drop-down"><a href="">Services</a>
                        <ul class="drop-item">
                            <li><a href="auction.php">Auction</a></li>
                            <li><a href="index.php#upcoming-auction">Upcoming Auction</a></li>
                            <li><a href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="drop-down"><a href="">Contact Us</a>
                        <ul class="drop-item">
                            <li><a href="#footer">Contact No</a></li>
                            <li><a href="#footer">Email</a></li>
                            <li><a href="#footer">Location</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="user">
                <?php
                $ID = $buyerID = $sellerID = $adID = $AID = '';
                if (isset($_SESSION['bu_userid']) || isset($_SESSION['se_userid']) || isset($_SESSION['ad_userid'])) {
                    if (isset($_SESSION['bu_userid'])) {
                        $buyerID = $_SESSION['bu_userid'];
                        $userImgQ = mysqli_query($conn, "SELECT first_name, last_name, `user_img` FROM `users` WHERE `user_id` = $buyerID");
                        $userImg = mysqli_fetch_assoc($userImgQ);
                        $ID = $userImg;
                    } elseif (isset($_SESSION['se_userid'])) {
                        $sellerID = $_SESSION['se_userid'];
                        $userImgQ = mysqli_query($conn, "SELECT first_name, last_name, `user_img` FROM `users` WHERE `user_id` = $sellerID");
                        $userImg = mysqli_fetch_assoc($userImgQ);
                        $ID = $userImg;
                    } elseif (isset($_SESSION['ad_userid'])) {
                        $adID = $_SESSION['ad_userid'];
                        $adImgQ = mysqli_query($conn, "SELECT `ad_firstname`, `ad_lastname`, `ad_img` FROM `administrate` WHERE `ad_id` = $adID");
                        $adImg = mysqli_fetch_assoc($adImgQ);
                        $AID = $adImg;
                    }
                    mysqli_close($conn);
                    if ($ID || $AID) {
                        $IMG = $firstname = $lastname = $hostnam = '';
                        if ($ID) {
                            $IMG = $USER_IMAGE_PATH . $ID['user_img'];
                            $firstname = $ID['first_name'];
                            $lastname = $ID['last_name'];
                            $hostnam = $hostname . 'seller/overview.php';
                        } else {
                            $IMG = $ADMIN_IMAGE_PATH . $AID['ad_img'];
                            $firstname = $AID['ad_firstname'];
                            $lastname = $AID['ad_lastname'];
                            $hostnam = $hostname . 'admin/overview.php';
                        }
                        echo "<div class='avatar'><img id='profImg' onclick=profil() src='{$IMG}'></div>
                        <div class='profile' id='profile'>
                            <ul class='pro-drop'>
                                <span>{$firstname} {$lastname}</span>
                                <li><a href='{$hostnam}'>Dashboard</a></li>
                                <li><a href='profile.php'>Profile</a></li>
                                <li><a href='change-password.php'>Change Password</a></li>
                                <li><a href='logout.php'>Logout</a></li>
                            </ul>
                        </div>";
                    } else {
                        echo "<div class='avatar'><img id='profImg'  onclick=profil() src='{$TEMP_IMAGE_PATH}'></div>
                        <span>{$firstname} {$lastname}</span>
                        <div class='profile' id='profile'>
                            <ul class='pro-drop'>
                                <li><a href='$hostnam'>Dashboard</a></li>
                                <li><a href='profile.php'>Profile</a></li>
                                <li><a href='change-password.php'>Change Password</a></li>
                                <li><a href='logout.php'>Logout</a></li>
                            </ul>
                        </div>";
                    }
                } else {
                    echo "
                    <span class='user-link'>
                    <button type='button' onclick=popup('popup-login')>Login</button> /
                    <button type='button' onclick=popup('popup-register')> Register</button>
                </span>";
                } ?>
            </div>

            <!-- Login / Register and Forget File -->
            <?php include 'user.php'; ?>

        </div>
    </div>
    <!-- Menu Section End -->

    <script>
        function disableButton() {
            $('#login-email-btn').attr('disabled', 'disabled');
            $('#login-email-btn').css("background-color", "grey");
        }

        function enableButton() {
            $('#login-email-btn').removeAttr('disabled');
            $('#login-email-btn').removeAttr('style');
        }
        $('#resmenu').on('click', ()=>{
            menu = document.getElementById('resuldis');
            if (menu.style.display == 'flex') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'flex'
            }
        })
        function popup(popup_nam) {
            get_popup = document.getElementById(popup_nam);
            if (get_popup.style.display == 'flex') {
                get_popup.style.display = 'none';
            } else {
                get_popup.style.display = 'flex'
            }
        }

        function forgetPopup() {
            document.getElementById('popup-login').style.display = 'none';
            document.getElementById('forget-login').style.display = 'flex';
        }

        function loginPopup() {
            document.getElementById('popup-login').style.display = 'flex';
            document.getElementById('forget-login').style.display = 'none';
        }

        function profil() {
            get_profile = document.getElementById('profile');
            if (get_profile.style.display == 'flex') {
                get_profile.style.display = 'none';
            } else {
                get_profile.style.display = 'flex'
            }
        }
    </script>
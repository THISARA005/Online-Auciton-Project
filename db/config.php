<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'eauction';
$conn = mysqli_connect($host , $user , $password , $db ) or die('Db Connection failed' . mysqli_connect_error());

$hostname = 'http://localhost/MyFolder/MarqueBeyond/MarqueBeyond/admin';

$TEMP_IMAGE_PATH = 'assets/img/avatar.png';
$USER_IN_IMAGE_PATH = '../uploaded/seprofileimg/';
$USER_IMAGE_PATH = 'uploaded/seprofileimg/';
$COMP_IN_IMAGE_PATH = '../uploaded/secompanyimg/';
$COMP_IMAGE_PATH = 'uploaded/secompanyimg/';
$ADMIN_IN_IMAGE_PATH = '../uploaded/eprofileimg/';
$ADMIN_IMAGE_PATH = 'admin/image/';
$SLIDER_IMAGE_PATH = 'assets/img/album/';
$VEHICLE_IN_IMAGE_PATH = '../uploaded/vehiclesImg/';
$VEHICLE_IMAGE_PATH = 'uploaded/vehiclesImg/';
$VEHICLE_TEMP_IMAGE_PATH = 'uploaded/vehiclesImg/car1.jpg';
$NEWS_IMAGE_PATH = 'uploaded/news/';
$GALLARY_IMAGE_PATH = 'uploaded/gallary/';
$CHOOSE_IMAGE_PATH = 'assets/img/car11.jpg';
$CLIENT_IMAGE_PATH = 'assets/img/client/';
$CLIENT_TEMP_IMAGE_PATH = 'assets/img/logo.jpg';

?>
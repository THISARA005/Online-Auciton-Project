
<?php
    $host = 'localhost';
    $user = 'root';
    $passcode = '';
    $db = 'eauction';
    $conn = mysqli_connect($host , $user , $passcode , $db) or die('Connection Failed');
    $hostname = 'http://localhost/MyFolder/MarqueBeyond/MarqueBeyond/admin';
    $mainhost = 'http://localhost/MyFolder/MarqueBeyond/MarqueBeyond/';
    $ADMIN_IMAGE_PATH = 'assets/images/';
    $LOGO_IMAGE_PATH = 'assets/images/logo.jpg';
?>
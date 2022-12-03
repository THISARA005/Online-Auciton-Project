<?php 
session_start();
include '../db/config.php';
if(isset($_SESSION['se_userid'])){
header("Location: overview.php");}
else{
    header("Location: {$hostname}");
}
mysqli_close($conn);
?>
<?php 
session_start();
if(isset($_SESSION['bu_userid'])){
    header("Location: overview.php");}
    else{
        header("Location: {$hostname}");
    }
    mysqli_close($conn);
?>
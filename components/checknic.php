<?php
include '../db/config.php';
if(isset($_POST['submit_nic'])){
    $nicno = $_POST['nic_id'];
        $nicno = strtolower($nicno);
    $nicCheck = mysqli_query($conn, "SELECT `address_id` FROM `address` WHERE `nic_no` = '$nicno'");
    if (mysqli_num_rows($nicCheck) > 0) {
        echo  "Following NIC is already exits";
    } else {
        if(preg_match("/^([0-9]{9}[x|X|v|V])$/", $nicno)){
            echo '';
        }else{
            echo "<b>Invalid !</b> NIC number";
        }
    }
}
mysqli_close($conn);
?>
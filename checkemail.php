<?php

include './db/config.php';
if(isset($_POST['submit_data'])){
    
$email = $_POST['email_id'];
$email = strtolower($email);
if (mysqli_num_rows(mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email'")) > 0) {
    echo "Following email is already exits";
}else{
    if(preg_match("/([a-z|0-9]+@gmail\.com|@yahoo\.com|@email\.com|@hotmail\.com)$/i", $email)){
        echo '';
    }else{
               echo "<b>Invalid !</b> email address";
    }
}
}
mysqli_close($conn);

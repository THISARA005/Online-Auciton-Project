<?php include './component/header.php' ?>

<div class="chng-pass">
    <h3>Set New Password</h3>
    <?php include '../db/config.php';
    $userid = $_SESSION['bu_userid'];
    $success = $error = $error1 = '';
    if (isset($_POST['change'])) {
        $selectSedata = mysqli_query($conn, "SELECT `pasword` FROM `users` 
        WHERE users.user_id = $userid");
        $seData = mysqli_fetch_assoc($selectSedata);
        $feOld = mysqli_real_escape_string($conn, $seData['pasword']);
        $old = sha1($_POST['old_pass']);
        if($old === $feOld){
            $newpass = mysqli_real_escape_string($conn, $_POST['new_pass']);
            $newcpass = mysqli_real_escape_string($conn, $_POST['new_cpass']);
            if($newpass === $newcpass){
                $newpass = sha1($newpass);
                $newcpass = sha1($newcpass);
                
                if(mysqli_query($conn, "UPDATE `users` SET pasword = '$newpass' WHERE users.user_id = $userid")){
                    $success = "<small style='color : green;'>Password Successfully Changed</small>";
                }else{
                    $success = "<small style='color : red;'>Failed To Update Password</small>";
                }
            }else{
                $error1 = "<small style='color : red;'>Please Enter both password Same</small>";
            }
        }else{
            $error = "<small style='color : red;'>Please Correct Old password</small>";
        }
    }
    echo $success;
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="group-data">
            <label>Old Password</label>
            <input type="password" name="old_pass" class="control-data" placeholder="Old Password" required />
            <?php $error; ?>
        </div>
        <div class="group-data">
            <label>New Password</label>
            <input type="password" name="new_pass" class="control-data" placeholder="New Password" required />
        </div>
        <div class="group-data">
            <label>Confirm Password</label>
            <input type="password" name="new_cpass" class="control-data" placeholder="Confirm Password" required />
            <?php $error ?>
        </div>
        <div class="btn">
            <input type="submit" name="change" class="btn button" value="Submit">
        </div>
    </form>
    
</div>

<?php include './component/footer.php' ?>
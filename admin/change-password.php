<?php include './component/header.php' ?>

<div class="chng-pass">
    <h3>Set New Password</h3>
    <?php 
    include 'db/config.php';
    $adid = $_SESSION['ad_userid'];
    $error = $error1 = $success = '';
    if(isset($_POST['save_pass'])){
    $selectAddata = mysqli_query($conn, "SELECT ad_password FROM `administrate` WHERE ad_id = $adid");
    $adData = mysqli_fetch_assoc($selectAddata);
    
    if(sha1($_POST['old_pass']) === $adData['ad_password']){
        $pass = sha1($_POST['new_pass']);
        $cpass = sha1($_POST['new_cpass']);

        if($pass === $cpass){
         if(mysqli_query($conn, "UPDATE `administrate` SET `ad_password` = '$pass' WHERE ad_id = $adid")){
            $success =  "<small style='color:green'>Password Successfully Changed</small>";
         }else{
            $success = "<small style='color:red'>Failed To Update Password</small>";
         }
        }else{
            $error1 = "<small style='color:red'>Please Enter Both Password same</small>";
        }
    }else{
        $error =  "<small style='color:red'>Please Enter Correct Password</small>";
    }

}
    ?>
            <?php echo $success ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="group-data">
            <label>Old Password</label>
            <input type="password" name="old_pass" class="control-data" placeholder="Old Password" required />
            <?php echo $error ?>
        </div>
        
        <div class="group-data">
            <label>New Password</label>
            <input type="password" name="new_pass" class="control-data" placeholder="New Password" required />
        </div>
        <div class="group-data">
            <label>Confirm Password</label>
            <input type="password" name="new_cpass" class="control-data" placeholder="Confirm Password" required />
            <?php echo $error1 ?>
        </div>
        <div class="btn">
            <input type="submit" name="save_pass" class="btn button" value="Submit">
        </div>
    </form>
</div>

<?php include './component/footer.php' ?>
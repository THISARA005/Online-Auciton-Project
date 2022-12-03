
<?php include './component/header.php' ?>
<link rel="stylesheet" href="assets/css/profile.css">
<div class="prof">

    <?php include 'db/config.php';
    $adid = $_SESSION['ad_userid'];
    $disable = 'disabled';
    $selectAddata = mysqli_query($conn, "SELECT * FROM `administrate` WHERE ad_id = $adid");
    $adData = mysqli_fetch_assoc($selectAddata);
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <div class="sre-2">
            <div class="img">
                <img src="<?php echo $ADMIN_IMAGE_PATH.$adData['ad_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" <?php echo "{$disable}" ?> name="seprofile">
            </div>
        </div>
        <div class="name sre-2">
            <div class="">
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="sefname" <?php echo " {$disable} value='{$adData['ad_firstname']}'" ?>>
                </div>
            </div>
            <div class="">
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="selname" <?php echo " {$disable} value='{$adData['ad_lastname']}'" ?>>
                </div>
            </div>
        </div>
        <div class="email sre-1">
            <label>Email</label>
            <div class="input">
                <input type="email" name="seemail" <?php echo " {$disable} value='{$adData['ad_email']}'" ?>>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Company Name</label>
            <input type="text" name="secompname" <?php echo " {$disable} value='{$adData['ad_address']}'" ?>>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="secontact" <?php echo " {$disable} value='{$adData['ad_contact']}'" ?>>
        </div>
        <div class="submit">
            <button type="submit" name="ad_signup">Edit</button>
        </div>
    </form>
    <?php if(isset($_POST['ad_signup'])){
        header("Location: {$hostname}edit_profile.php");
    } 
    
    ?>
</div>
<?php include './component/footer.php' ?>

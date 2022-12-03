<?php include './component/header.php' ?>
<div class="prof">
    <?php 
    include '../db/config.php';
    $userid = $_SESSION['se_userid'];
    $disable = 'disabled';
    if(isset($_POST['editprof'])){
        header("Location: edit_profile.php");
    }

    $selectSedata = mysqli_query($conn, "SELECT * FROM `users` 
    LEFT JOIN `company` ON users.comp_id = company.comp_id WHERE users.user_id = $userid");
    $seData = mysqli_fetch_assoc($selectSedata);
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
        <div class="sre-2">
            <div class="img">
                <img src="<?php echo $USER_IN_IMAGE_PATH.$seData['user_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" <?php echo "{$disable}" ?> name="seprofile">
            </div>
        </div>
        <div class="name sre-2">
            <div>
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="sefname" <?php echo " {$disable} value='{$seData['first_name']}'" ?>>
                </div>
            </div>
            <div>
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="selname" <?php echo " {$disable} value='{$seData['last_name']}'" ?>>
                </div>
            </div>
        </div>
        <div class="email sre-1">
            <label>Email</label>
            <div class="input">
                <input type="email" name="seemail" <?php echo " {$disable} value='{$seData['email']}'" ?>>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Company Name</label>
            <input type="text" name="secompname" <?php echo " {$disable} value='{$seData['comp_nam']}'" ?>>
        </div>
        <div class="comp-re-nmbr sre-1">
            <label>Company Registration Number</label>
            <input type="text" name="secompreg" <?php echo " {$disable} value='{$seData['comp_reg']}'" ?>>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="secontact" <?php echo " {$disable} value='{$seData['contact']}'" ?>>
        </div>
        <div class="sre-2 comp">
            <div class="updateimg">
                <label>Update Company Image</label>
                <input type="file" <?php echo "{$disable}" ?> name="seprofile" >
            </div>
            <div class="img">
                <img src="<?php echo $COMP_IN_IMAGE_PATH.$seData['comp_img'] ?>">
            </div>
        </div>
        <div class="submit">
            <button type="submit" name="editprof">Edit</button>
        </div>
    </form>
    
</div>

<?php include './component/footer.php' ?>
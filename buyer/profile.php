<?php include './component/header.php' ?>
<div class="prof">

    <?php 
    include '../db/config.php';
    $userid = $_SESSION['bu_userid'];
    $disable = 'disabled';
    $selectdata = mysqli_query($conn, "SELECT * FROM `users` 
    LEFT JOIN `address` ON users.address_id = `address`.address_id WHERE users.user_id = $userid");
    $Data = mysqli_fetch_assoc($selectdata);

    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <div class="sre-2">
            <div class="img">
                <img src="<?php echo $USER_IN_IMAGE_PATH . $Data['user_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" <?php echo " {$disable} " ?> name="buprofile">
            </div>
        </div>
        <div class="name sre-2">
            <div class="">
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="bufname" <?php echo " {$disable} value='{$Data['first_name']}'" ?>>
                </div>
            </div>
            <div class="">
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="bulname" <?php echo " {$disable} value='{$Data['last_name']}'" ?>>
                </div>
            </div>
        </div>
        <div class="email sre-1">
            <label>Email</label>
            <div class="input">
                <input type="email" name="buemail" <?php echo " {$disable} value='{$Data['email']}'" ?>>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Address</label>
            <input type="text" name="bucompname" <?php echo " {$disable} value='{$Data['address']}'" ?>>
        </div>
        <div class="comp-re-nmbr sre-1">
            <label>NIC Number</label>
            <input type="text" name="bucompreg" <?php echo " {$disable} value='{$Data['nic_no']}'" ?>>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="bucontact" <?php echo " {$disable} value='{$Data['contact']}'" ?>>
        </div>
        <div class="submit">
            <button type="submit" name="edit">Edit</button>
        </div>
    </form>
    <?php
    if (isset($_POST['edit'])) {
        header("Location: edit_profile.php");
    }
    ?>
</div>
<?php include './component/footer.php' ?>
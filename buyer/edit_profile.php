<?php include './component/header.php' ?>
<div class="prof">
    <?php include '../db/config.php';
    $userid = $_SESSION['bu_userid'];
    $disable = 'disabled';
    $selectdata = mysqli_query($conn, "SELECT * FROM `users`
    LEFT JOIN `address` ON `users`.`address_id` = `address`.`address_id`
    WHERE users.user_id = $userid");
    $Data = mysqli_fetch_assoc($selectdata);
    $addressid = $Data['address_id'];
    
    //------------------------------------------------
    
    if (isset($_POST['save'])) {
        $bupimg_name = '';
        $error = [];
        $date = date('Y-m-d');
        if ($_FILES['buprofile']['name'] !== '') {
            $bupimg_name = $_FILES['buprofile']['name'];
            $bupimg_type = pathinfo($bupimg_name, PATHINFO_EXTENSION);
            $bupimg_name = uniqid() . $date . '.' . $bupimg_type;
            $bupimg_tmpname = $_FILES['buprofile']['tmp_name'];

            if (empty($error) == true) {
                unlink($USER_IN_IMAGE_PATH.$Data['user_img']);
                move_uploaded_file($bupimg_tmpname, $USER_IN_IMAGE_PATH . $bupimg_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            $bupimg_name = $Data['user_img'];
        }
        $fname = mysqli_real_escape_string($conn, $_POST['bufname']);
        $lname = mysqli_real_escape_string($conn, $_POST['bulname']);
        $contact = mysqli_real_escape_string($conn, $_POST['bucontact']);
        $address = mysqli_real_escape_string($conn, $_POST['buaddress']);
        $updateBu = mysqli_query($conn, "UPDATE `users` 
        SET `first_name` = '$fname', `last_name` = '$lname', `user_img` = '$bupimg_name' , contact = '$contact' , `address_id` = $addressid 
        WHERE `user_id` = $userid");
        $updateAdres = mysqli_query($conn, "UPDATE `address` SET `address` = '$address' where `address_id` = $addressid");
        if ($updateBu && $updateAdres) {
            echo 'sucessfully Inserted';
            echo "<script>
                        window.location.href = 'profile.php';
                    </script>";
            sleep(2);
        } else {
            echo "Updation error";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="sre-2">
            <div class="img">
                <img id="buprofileimg" src="<?php echo $USER_IN_IMAGE_PATH.$Data['user_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" id="file1" name="buprofile">
            </div>
        </div>
        <div class="field-error">
            <li id="file1-error"></li>
        </div>
        <div class="name sre-2">
            <div class="">
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="bufname" id="fname" <?php echo " value='{$Data['first_name']}'" ?> required>
                </div>
            </div>
            <div class="">
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="bulname" id="lname" <?php echo " value='{$Data['last_name']}'" ?> required>
                </div>
            </div>
        </div>
        <div class="field-error">
            <li id="fname-error"></li>
            <li id="lname-error"></li>
        </div>
        <div class="email sre-1">
            <label>Email</label>
            <div class="input">
                <input type="email" name="buemail" <?php echo " {$disable} value='{$Data['email']}'" ?> required>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Address</label>
            <input type="text" name="buaddress" <?php echo " value='{$Data['address']}'" ?> required>
        </div>
        <div class="comp-re-nmbr sre-1">
            <label>NIC Number</label>
            <input type="text" name="bunic" <?php echo " {$disable} value='{$Data['nic_no']}'" ?> required>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="bucontact" id="phone" <?php echo " value='{$Data['contact']}'" ?> required>
        </div>
        <div class="field-error">
            <li id="phone-error"></li>
            <li id="phone-error1"></li>
        </div>
        <div class="submit">
            <button type="submit" id="save-data" name="save">Save</button>
        </div>
    </form>
    
</div>

<script>
    var nameptrn = /^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
    var phonePtrn = /^(?:7|0|(?:\+94))[-]{1}[0-9]{2}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/;

    $(document).ready(function() {
        $('#file1').click().change(function(e) {
            var error = '';
            if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                error += (`<b>Invalid !</b> ${e.target.files[0].name}. Please upload image of given formate (png, jpeg , jpg)`);
            }else{
                error = '';
                $('#buprofileimg').attr('src', URL.createObjectURL(e.target.files[0]))
            }
            if (error) {
                $(`#file1-error`).html(error);
                disableButton();
            } else {
                $(`#file1-error`).html('');
                enableButton();
            }
        })
    function disableButton() {
        $('#save-data').attr('disabled', 'disabled');
        $('#save-data').css("background-color", "grey");
    }

    function enableButton() {
        $('#save-data').removeAttr('disabled');
        $('#save-data').removeAttr('style');
    }
    $('#fname').keyup(() => {
        var val = $('#fname').val().length;
        if (!nameptrn.test($('#fname').val())) {
            $('#fname-error').html('<b>Invalid !</b> First name must be Greater then 4 Character');
            disableButton();
        } else {
            $('#fname-error').html('');
            enableButton();
        }
    })
    $('#lname').keyup(() => {
        var val = $('#lname').val().length;
        if (!nameptrn.test($('#lname').val())) {
            $('#lname-error').html('<b>Invalid !</b> Last name must be Greater then 4 Character');
            disableButton();
        } else {
            $('#lname-error').html('');
            enableButton();
        }
    })
    $('#phone').blur(() => {
        if (phonePtrn.test($('#phone').val())) {
            $('#phone-error').html('');
            $('#phone-error1').html('');
            enableButton();
        } else {
            $('#phone-error').html('<b>Invalid !</b> phone number');
            $('#phone-error1').html('Please follow this formate <b>+94-11-123-4567</b>');
            disableButton();
        }
    })
})

</script>
<?php include './component/footer.php' ?>
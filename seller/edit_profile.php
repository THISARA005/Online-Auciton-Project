<?php include './component/header.php' ?>
<div class="prof">
    <?php include '../db/config.php';
    $userid = $_SESSION['se_userid'];
    $disable = 'disabled';
    $selectSedata = mysqli_query($conn, "SELECT * FROM `users` 
    LEFT JOIN `company` ON users.comp_id = company.comp_id WHERE users.user_id = $userid");
    $seData = mysqli_fetch_assoc($selectSedata);
    $compid = $seData['comp_id'];
    $date = date('Y-m-d');

    // ------------------------------------- //
    
    if (isset($_POST['save'])) {
        $sepimg_name = $secompimg_name = '';
        $error = [];
        if ($_FILES['seprofile']['name'] !== '') {
            $sepimg_name = $_FILES['seprofile']['name'];
            $sepimg_type = pathinfo($sepimg_name, PATHINFO_EXTENSION);
            $sepimg_name = uniqid() . $date . '.' . $sepimg_type;
            $sepimg_tmpname = $_FILES['seprofile']['tmp_name'];


            if (empty($error) == true) {
                unlink($USER_IN_IMAGE_PATH.$seData['user_img']);
                move_uploaded_file($sepimg_tmpname, $USER_IN_IMAGE_PATH . $sepimg_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            $sepimg_name = $seData['user_img'];
        }
        if ($_FILES['secompimg']['name'] !== '') {
            $secompimg_name = $_FILES['secompimg']['name'];
            $secompimg_type = pathinfo($secompimg_name, PATHINFO_EXTENSION);
            $secompimg_name = uniqid() . $date . '.' . $secompimg_type;
            $secompimg_tmpname = $_FILES['secompimg']['tmp_name'];

            if (empty($error) == true) {
                unlink($COMP_IN_IMAGE_PATH.$seData['comp_img']);
                move_uploaded_file($secompimg_tmpname, $COMP_IN_IMAGE_PATH . $secompimg_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            $secompimg_name = $seData['comp_img'];
        }
        $fname = mysqli_real_escape_string($conn, $_POST['sefname']);
        $lname = mysqli_real_escape_string($conn, $_POST['selname']);
        $contact = mysqli_real_escape_string($conn, $_POST['secontact']);
        $compimgUpdate = mysqli_query($conn, "UPDATE `company` SET comp_img = '$secompimg_name' WHERE `comp_id` = $compid") or die('fail2');
        $updateSe = mysqli_query($conn, "UPDATE `users` SET `first_name` = '$fname', `last_name` = '$lname', `user_img` = '$sepimg_name' , `contact` = $contact WHERE `user_id` = $userid");
        if ($updateSe && $compimgUpdate) {
            echo 'sucessfully Inserted';
            echo "<script>
                        window.location.href = 'profile.php';
                    </script>";
        } else {
            echo "Updation error";
        }
    }

    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="sre-2">
            <div class="img">
                <img id="seprofileimg" src="<?php echo $USER_IN_IMAGE_PATH.$seData['user_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" id="file1" name="seprofile">
            </div>
        </div>
        <div class="field-error">
            <li id="file1-error"></li>
        </div>
        <div class="name sre-2">
            <div class="">
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="sefname" id="fname" <?php echo " value='{$seData['first_name']}'" ?> required>
                </div>
            </div>
            <div class="">
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="selname" id="lname" <?php echo " value='{$seData['last_name']}'" ?> required>
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
                <input type="email" name="seemail" <?php echo " {$disable} value='{$seData['email']}'" ?> required>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Company Name</label>
            <input type="text" name="secompname" <?php echo " {$disable} value='{$seData['comp_nam']}'" ?> required>
        </div>
        <div class="comp-re-nmbr sre-1">
            <label>Company Registration Number</label>
            <input type="text" name="secompreg" <?php echo " {$disable} value='{$seData['comp_reg']}'" ?> required>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="secontact" id="phone" <?php echo " value='{$seData['contact']}'" ?> required>
        </div>
        <div class="field-error">
            <li id="phone-error"></li>
            <li id="phone-error1"></li>
        </div>
        <div class="sre-2 comp">
            <div class="updateimg">
                <label>Update Company Image</label>
                <input type="file" name="secompimg" id="file2">
            </div>
            <div class="img">
                <img id="secompimg" src="<?php echo $COMP_IN_IMAGE_PATH.$seData['comp_img'] ?>">
            </div>
        </div>
        <div class="field-error">
            <li id="file2-error"></li>
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
            } else {
                error = '';
                $('#seprofileimg').attr('src', URL.createObjectURL(e.target.files[0]))
            }
            if (error) {
                $(`#file1-error`).html(error);
                disableButton();
            } else {
                $(`#file1-error`).html('');
                enableButton();
            }
        })
        $('#file2').click().change(function(e) {
            var error = '';
            if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                error += (`<b>Invalid !</b> ${e.target.files[0].name}. Please upload image of given formate (png, jpeg , jpg)`);
            } else {
                error = '';
                $('#secompimg').attr('src', URL.createObjectURL(e.target.files[0]))
            }
            if (error) {
                $(`#file2-error`).html(error);
                disableButton();
            } else {
                $(`#file2-error`).html('');
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
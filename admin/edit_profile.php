
<?php include './component/header.php' ?>
<link rel="stylesheet" href="assets/css/profile.css">
<div class="prof">

    <?php include 'db/config.php';
    $adid = $_SESSION['ad_userid'];
    
    $selectAddata = mysqli_query($conn, "SELECT * FROM `administrate` WHERE ad_id = $adid");
    $adData = mysqli_fetch_assoc($selectAddata);
    ?>
    <?php
    if(isset($_POST['ad_update'])){
        $ad_img = '';
        if(empty($_FILES['adprofile']['name'])){
            $file_name = $_POST['old_img'];
          }else {
            $error = array();
            $adpimg_name = $_FILES['adprofile']['name'];
            $adpimg_type = pathinfo($adpimg_name, PATHINFO_EXTENSION);
            $adpimg_name = uniqid() . $date . '.' . $adpimg_type;
            $adpimg_tmpname = $_FILES['adprofile']['tmp_name'];
            
            if (empty($error) === true) {
                unlink($ADMIN_IMAGE_PATH.$_POST['old_img']);
                move_uploaded_file($adpimg_tmpname, $ADMIN_IMAGE_PATH . $adpimg_name) or die('img not uploaded');
            } else {
                echo '<pre>';
                print_r($error);
                echo '</pre>';
                die();
            }
        }

        $adfname = mysqli_real_escape_string($conn, $_POST['adfname']);
        $adlname = mysqli_real_escape_string($conn, $_POST['adlname']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $adcontact = mysqli_real_escape_string($conn, $_POST['adcontact']);

        $updateAd = "UPDATE `administrate` 
        SET `ad_firstname` = '$adfname', ad_lastname = '$adlname', `ad_address` = '$address', `ad_contact` = '$adcontact', ad_img = '$adpimg_name' WHERE ad_id = $adid";
        
        if(mysqli_query($conn, $updateAd)){
            echo 'sucessfully Inserted';
            echo "<script>
                        window.location.href = 'profile.php';
                    </script>";
        }else{
            echo "Updation error";
        }

    }
    
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <div class="sre-2">
            <div class="img">
                <img id="adprofileimg" src="<?php echo $ADMIN_IMAGE_PATH.$adData['ad_img'] ?>" alt="">
            </div>
            <div class="updateimg">
                <label>Update Profile Image</label>
                <input type="file" id="file1" name="adprofile">
                <input type="hidden" name="old_img" value="<?php echo $adData['ad_img']; ?>" >
            </div>
        </div>
        <div class="field-error">
            <li id="file1-error"></li>
        </div>
        <div class="name sre-2">
            <div>
                <label>First Name</label>
                <div class="input">
                    <input type="text" name="adfname" id="fname" <?php echo " value='{$adData['ad_firstname']}'" ?> required>
                </div>
            </div>
            <div>
                <label>Last Name</label>
                <div class="input">
                    <input type="text" name="adlname" id="lname" <?php echo " value='{$adData['ad_lastname']}'" ?> required>
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
                <input type="email" disabled name="ademail" <?php echo " value='{$adData['ad_email']}'" ?> required>
            </div>
        </div>
        <div class="comp-name sre-1">
            <label>Address</label>
            <input type="text" name="address" <?php echo " value='{$adData['ad_address']}'" ?> required>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="adcontact" id="phone" <?php echo " value='{$adData['ad_contact']}'" ?> required>
        </div>
        <div class="field-error">
            <li id="phone-error"></li>
            <li id="phone-error1"></li>
        </div>
        <div class="submit">
            <button type="submit" id="save-data" name="ad_update">Update</button>
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
                $('#adprofileimg').attr('src', URL.createObjectURL(e.target.files[0]))
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

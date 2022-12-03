<?php
include '../db/config.php';
include './component/header.php'; // Header 

if (!isset($_SESSION['cod'])) header("Location: {$hostname}seller/host-auction.php");

$code = $_SESSION['cod'];
$seid = $_SESSION['se_userid'];
$curDate = date_default_timezone_set("Asia/Colombo");
$curDate = date('Y-m-d');
$result = mysqli_query($conn, "SELECT `code`, `code_date` FROM `verified_auction` WHERE `user_id` = $seid AND `code` = '$code' AND `code_date` >= '$curDate'");
if (mysqli_num_rows($result) <= 0) {
    header("Location: {$hostname}seller/host-auction.php");
}
$cwrite = mysqli_fetch_assoc($result);
$date = $cwrite['code_date'];
$checkCode = mysqli_query($conn, "SELECT `ve_code` FROM `vehicles` WHERE ve_code = '$code'");
$checkCode = mysqli_num_rows($checkCode);
if ($checkCode === 0) {

?>
    <?php
    if (isset($_POST['addAuc'])) {

        $error = array();
        $veimg1_name = $veimg2_name = $veimg3_name = $veimg4_name = $veimg5_name = '';
        if (empty($_FILES['img1']['name']) === false) {
            $veimg1_name = $_FILES['img1']['name'];
            $veimg1_type = pathinfo($veimg1_name, PATHINFO_EXTENSION);
            $veimg1_name = uniqid() . $curDate . '.' . $veimg1_type;
            $veimg1_tmpname = $_FILES['img1']['tmp_name'];
            
            if (empty($error) === true) {
                move_uploaded_file($veimg1_tmpname, $VEHICLE_IN_IMAGE_PATH . $veimg1_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            echo "fail";
        }
        if (empty($_FILES['img2']) === false) {
            $veimg2_name = $_FILES['img2']['name'];
            $veimg2_type = pathinfo($veimg2_name, PATHINFO_EXTENSION);
            $veimg2_name = uniqid() . $curDate . '.' . $veimg2_type;
            $veimg2_tmpname = $_FILES['img2']['tmp_name'];
            
            if (empty($error) === true) {
                move_uploaded_file($veimg2_tmpname, $VEHICLE_IN_IMAGE_PATH . $veimg2_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            echo "fail";
        }
        if (empty($_FILES['img3']) === false) {
            $veimg3_name = $_FILES['img3']['name'];
            $veimg3_type = pathinfo($veimg3_name, PATHINFO_EXTENSION);
            $veimg3_name = uniqid() . $curDate . '.' . $veimg3_type;
            $veimg3_tmpname = $_FILES['img3']['tmp_name'];
            
            if (empty($error) === true) {
                move_uploaded_file($veimg3_tmpname, $VEHICLE_IN_IMAGE_PATH . $veimg3_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            echo "fail";
        }
        if (empty($_FILES['img4']) === false) {
            $veimg4_name = $_FILES['img4']['name'];
            $veimg4_type = pathinfo($veimg4_name, PATHINFO_EXTENSION);
            $veimg4_name = uniqid() . $curDate . '.' . $veimg4_type;
            $veimg4_tmpname = $_FILES['img4']['tmp_name'];
            
            if (empty($error) === true) {
                move_uploaded_file($veimg4_tmpname, $VEHICLE_IN_IMAGE_PATH . $veimg4_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            echo "fail";
        }
        if (empty($_FILES['img5']) === false) {
            $veimg5_name = $_FILES['img5']['name'];
            $veimg5_type = pathinfo($veimg5_name, PATHINFO_EXTENSION);
            $veimg5_name = uniqid() . $curDate . '.' . $veimg5_type;
            $veimg5_tmpname = $_FILES['img5']['tmp_name'];
            
            if (empty($error) === true) {
                move_uploaded_file($veimg5_tmpname, $VEHICLE_IN_IMAGE_PATH . $veimg5_name) or die('img not uploaded');
            } else {
                print_r($error);
                die();
            }
        } else {
            echo "fail";
        }

        $vemake = $_POST['ve_make'];
        $vetype = $_POST['ve_type'];
        $veyear = $_POST['ve_year'];
        $vemodel = mysqli_real_escape_string($conn, $_POST['ve_model']);
        $vecolor = mysqli_real_escape_string($conn, $_POST['ve_color']);
        $vecond = $_POST['ve_cond'];
        $vetrans = $_POST['ve_transmission'];
        $vefuel = $_POST['ve_fuel'];
        $vecap = mysqli_real_escape_string($conn, $_POST['ve_cap']);
        $vemilage = mysqli_real_escape_string($conn, $_POST['ve_mileage']);
        $aucstrttime = $_POST['auc_strt_time'];
        $aucendtime = $_POST['auc_end_time'];
        $vedesc = mysqli_real_escape_string($conn, $_POST['ve_desc']);
        $veprice = mysqli_real_escape_string($conn, $_POST['ve_price']);

        $images = "$veimg1_name" . ',' . "$veimg2_name" . ',' . "$veimg3_name" . ',' . "$veimg4_name" . ',' . "$veimg5_name";
        $images = (string)($images);
        $insertVeRecordQ = "INSERT INTO `vehicles`(`ve_code`, `user_id`, `ve_typeid`, `ve_modelid`, `ve_makeid`, `ve_colorid`, `ve_conditionid`, `ve_year`, `ve_transmissionid`, `ve_fueltypeid`, `ve_encapacity`, `ve_mileage`, `ve_desc`, `ve_startprice`, `ve_img`, `ve_date`, `auc_strt_time`, `auc_end_time`, `ve_status`)
        VALUES ('$code' , $seid , $vetype , '$vemodel' , $vemake , '$vecolor' , $vecond , $veyear , $vetrans , $vefuel , '$vecap' , '$vemilage' , '$vedesc' , '$veprice' , '$images' , '$date' , '$aucstrttime' , '$aucendtime' , 0)";
        $insertVeRecord = mysqli_query($conn, $insertVeRecordQ);
        if ($insertVeRecord) {
            echo 'Record is Successfully Inserted';
            sleep(2);
            header("Location: {$hostname}seller/overview.php");
            unset($_SESSION['cod']);
        unset($_SESSION['validCode']);
        } else {
            echo "Failed to Insert record";
        }
    }
    ?>
    <!-- Add Vehicle Section Start -->
    <div class="host">
        <div class="heading add-vehicle" id="addvehicle">
            <h3>Add Vehicle Details</h3>
    
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="heading">
                    <h4>Vehicle Info</h4>
                    <div class="code">
                        <div>
                            <label>Auction code </label>
                            <input type="text" name="ve_code" value="<?php echo $code ?>" disabled>
                        </div>
                        <div>
                            <label>Auction Date</label>
                            <input type="text" name="ve_date" value="<?php echo $cwrite['code_date'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-data">
                        <label>Vehichel Make</label>
                        <select name="ve_make" required>
                            <option selected disabled>Select Make</option>
                            <?php
                            $selectMake = "SELECT * FROM `make`";
                            $makeResult = mysqli_query($conn, $selectMake) or die(' Make Query Failed');
                            if (mysqli_num_rows($makeResult) > 0) {
                                while ($make = mysqli_fetch_assoc($makeResult)) {
                                    echo "<option value='{$make['make_id']}'>{$make['make_nam']}</option>";
                                }
                            } ?>
                        </select>
                    </div>

                    <div class="form-data">
                        <label>Vehichel Type</label>
                        <select name="ve_type" required>
                            <option selected disabled>Select Type</option>
                            <?php $selectType = "SELECT * FROM `bodystyle`";
                            $typeResult = mysqli_query($conn, $selectType) or die('Type Query Failed');
                            if (mysqli_num_rows($typeResult) > 0) {
                                while ($type = mysqli_fetch_assoc($typeResult)) {
                                    echo "<option value='{$type['bodyst_id']}'>{$type['body_style']}</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-data">
                        <label>Manufactured Year</label>
                        <?php $selectYear = "SELECT * FROM `years`";
                        $yearResult = mysqli_query($conn, $selectYear) or die('Year Query Failed');
                        if (mysqli_num_rows($yearResult) > 0) {
                            while ($year = mysqli_fetch_assoc($yearResult)) {
                                echo "<option value='{$year['year_id']}'>{$year['year']}</option>";
                            }
                        } ?>
                        <input type="text" name="ve_year" placeholder="Year" required>
                    </div>
                    <div class="form-data">
                        <label>Model</label>
                        <input type="text" name="ve_model" placeholder="Model" required>
                    </div>
                    <div class="form-data">
                        <label>Color</label>
                        <input type="text" name="ve_color" placeholder="Color" required>
                    </div>
                    <div class="form-data">
                        <label>Vehicle Condition</label>
                        <select name="ve_cond" required>
                            <option selected disabled>Select Condition</option>
                            <?php $selectCondition = "SELECT * FROM `condition`";
                            $conditionResult = mysqli_query($conn, $selectCondition) or die('Year Query Failed');
                            if (mysqli_num_rows($conditionResult) > 0) {
                                while ($condition = mysqli_fetch_assoc($conditionResult)) {
                                    echo "<option value='{$condition['cond_id']}'>{$condition['ve_condition']}</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-data">
                        <label>Transmission</label>
                        <select name="ve_transmission" required>
                            <option selected disabled>Select Transmission</option>
                            <?php $selectTransmission = "SELECT * FROM `transmission`";
                            $transmissionResult = mysqli_query($conn, $selectTransmission) or die('Transmission Query Failed');
                            if (mysqli_num_rows($transmissionResult) > 0) {
                                while ($transmission = mysqli_fetch_assoc($transmissionResult)) {
                                    echo "<option value='{$transmission['trans_id']}'>{$transmission['trans_type']}</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-data">
                        <label>Fuel Type</label>
                        <select name="ve_fuel" required>
                            <option selected disabled>Select Fuel</option>
                            <?php $selectFuel = "SELECT * FROM `fuel_type`";
                            $fuelResult = mysqli_query($conn, $selectFuel) or die('Transmission Query Failed');
                            if (mysqli_num_rows($fuelResult) > 0) {
                                while ($fuel = mysqli_fetch_assoc($fuelResult)) {
                                    echo "<option value='{$fuel['fuel_id']}'>{$fuel['fuel_type']} </option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-data">
                        <label>Engine Capacity</label>
                        <input type="text" name="ve_cap" placeholder="Engine Capacity" required>
                    </div>
                    <div class="form-data">
                        <label>Mileage</label>
                        <input type="text" name="ve_mileage" placeholder="Mileage" required>
                    </div>
                    <div class="form-data time">
                        <label>Auction Start Time</label>
                        <input type="time" name="auc_strt_time" required>
                    </div>
                    <div class="form-data time">
                        <label>Auction End Time</label>
                        <input type="time" name="auc_end_time" required>
                    </div>
                    <div class="form-data">
                        <label>Addition Info</label>
                        <textarea name="ve_desc" placeholder="Furthure Information" id="" cols="30" rows="10" style="resize: none;" required></textarea>
                    </div>
                    <div class="form-data">
                        <label>Starting Price</label>
                        <input type="text" name="ve_price" pattern="[1-9]+" title="Value nust be greater then 0" required>
                    </div>
                    <div class="img-heading">
                        <p>Five Images are required <span>(Please Insert Five Images)</span></p>
                    </div>
                    <div class="images">
                        <div class="upfile"><img src="../assets/img/avatar.png" id="img1"><input type="file" name="img1" id="file1" required></div>
                        <div class="upfile"><img src="../assets/img/avatar.png" id="img2"><input type="file" name="img2" id="file2" required></div>
                        <div class="upfile"><img src="../assets/img/avatar.png" id="img3"><input type="file" name="img3" id="file3" required></div>
                        <div class="upfile"><img src="../assets/img/avatar.png" id="img4"><input type="file" name="img4" id="file4" required></div>
                        <div class="upfile"><img src="../assets/img/avatar.png" id="img5"><input type="file" name="img5" id="file5" required></div>
                    </div>
                    <div class="field-error">
                            <li id="image-error"></li>
                    </div>
                    <div class="btn">
                        <input type="submit" name="addAuc" id="upload" value="Upload Vehicle">
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Add Vehicle Section END -->
    <script>
        $(document).ready(function() {
            var error1 = error2 = error3 = error4 = error5 = '';
            $('#img1').click(function() {
                error1 = '';
                $('#file1').click().change(function(e) {
                    if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                        error1 += (`<br>Please upload image 1 ${e.target.files[0].name} of given formate (png, jpeg , jpg)`);
                        $(`#img1`).attr('src', '../assets/img/upload.jpg');
                    } else {
                        $('#img1').attr('src', URL.createObjectURL(e.target.files[0]));
                    }
                })
            })
            $('#img2').click(function() {
                error2 = '';
                $('#file2').click().change(function(e) {
                    if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                        error2 += (`<br>Please upload image 2 ${e.target.files[0].name} of given formate (png, jpeg , jpg)`);
                        $(`#img2`).attr('src', '../assets/img/upload.jpg');
                    } else {
                        $('#img2').attr('src', URL.createObjectURL(e.target.files[0]));
                    }

                })
            })
            $('#img3').click(function() {
                error3 = '';
                $('#file3').click().change(function(e) {
                    if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                        error3 += (`<br>Please upload image 3 ${e.target.files[0].name} of given formate (png, jpeg , jpg)`);
                        $(`#img3`).attr('src', '../assets/img/upload.jpg');
                    } else {
                        $('#img3').attr('src', URL.createObjectURL(e.target.files[0]));
                    }
                })
            })
            $('#img4').click(function() {
                error4 = '';
                $('#file4').click().change(function(e) {
                    if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                        error4 += (`<br>Please upload image 4 ${e.target.files[0].name} of given formate (png, jpeg , jpg)`);
                        $(`#img4`).attr('src', '../assets/img/upload.jpg');
                    } else {
                        $('#img4').attr('src', URL.createObjectURL(e.target.files[0]));
                    }
                })
            })
            $('#img5').click(function() {
                error5 = '';
                $('#file5').click().change(function(e) {
                    if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                        error5 += (`<br>Please upload image 5 ${e.target.files[0].name} of given formate (png, jpeg , jpg)`);
                        $(`#img5`).attr('src', '../assets/img/upload.jpg');
                    } else {
                        $('#img5').attr('src', URL.createObjectURL(e.target.files[0]));
                    }
                })
            })
            var error = error1 + error2 + error3 + error4 + error5;
            if (error) {
                $('#image-error').html(error);
                $('#upload').attr('disabled', 'disabled');
            } else {
                $('#image-error').html('');
            }
        })
    </script>
<?php } //Check Condition End
else {
    echo "<div class='hostRedirect'>You Have Already Entered vehicle Info. Your Are only Allowed to edit details.
    <a href='{$hostname}seller/host-auction.php'><b>Go back To Edit</b></a></div>
    ";
}


// Footer File
 include './component/footer.php'; 
 ?>
<?php include './component/header.php'; ?>

<div class="host">
    <div class="heading btn" id="hostbtn">
        <h3>Auction</h3>
        <?php
        include '../db/config.php';
        $seid = $_SESSION['se_userid'];
        $curDate = date('Y-m-d');
        date_default_timezone_set('Asia/Karachi');
        $date = date('H:i');
        $edit_error = $add_error = $code_error = $cod_error = '';
        $result3 = mysqli_query($conn, "SELECT `code`, `code_date` FROM `verified_auction` WHERE `user_id` = $seid AND `code_date` >= '$curDate' ORDER BY `code_date` ASC");
        // ------------------------------------------------------//

        // To Check Valid Code
        if (isset($_POST['codeVal'])) {
            $result1 = mysqli_query($conn, "SELECT `code`, `code_date` FROM `verified_auction` WHERE `user_id` = $seid AND `code_date` >= '$curDate' AND `code` = '$_POST[cod]'");
            if (mysqli_num_rows($result1) > 0) {
                $_SESSION['cod'] = $_POST['cod'];
                $_SESSION['validCode'] = true;
            } else {
                $cod_error = "<div class='error'><span>Enter Valid Code</span></div>";
            }
        }
        // ------------------------------------------------------ //

        // To Check Session Exist Or Not
        if (!isset($_SESSION['validCode'])) {
        
            // Enter Code

            echo "
            <form action={$_SERVER['PHP_SELF']} method='post'>
                <div class='code-input'>
                    <label>Enter Vehicle Code</label>
                    <input type='text' name='cod' placeholder='Enter Vehicle Code' required>
                </div>
                <div class='btn'>
                    <button type='submit' name='codeVal'>Add Vehicle</button>
                </div>
            </form>";
        ?>
        <div class='code_detail'>
                <?php
                if (mysqli_num_rows($result3) > 0) {
                    echo "<table>
                    <tr>
                        <th>Code</th>
                        <th>Date</th>
                    </tr>";
                    while ($codeDtl = mysqli_fetch_assoc($result3)) {
                        echo "<tr>
                        <td> {$codeDtl['code']} </td>
                        <td> {$codeDtl['code_date']} </td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    $code_error = "<div class='error'><span>Please Contact with admin through <b>Schedule Auction</b> Menu to proceed auction</span></div>";
                }
                ?>
                <?php echo $code_error; ?>
            </div>
        <?php 
        }
        ?>
        <!-- ----- Enter Valid Code ------- -->
        <?php if (isset($_SESSION['validCode']) && isset($_SESSION['cod']) && $_SESSION['validCode'] === true) { ?>
            <div id="vehicleData">
                <div class="btn">
                    <button type="submit" name="vecode"><a href="addvehicle.php">Add Vehicle</a></button>
                </div>
                <?php
                $code = $_SESSION['cod'];
                $result2 = mysqli_query($conn, "SELECT `code`, `code_date`, `auc_strt_time`, `ve_code` FROM `verified_auction` 
                LEFT JOIN `vehicles` ON `verified_auction`.`code` = `vehicles`.`ve_code`
                WHERE `verified_auction`.`user_id` = $seid AND `code_date` >= '$curDate' AND `ve_code` = '$code' AND auc_strt_time < '$date'");
                if (mysqli_num_rows($result2) > 0) {
                    $_SESSION['code'] = $code;
                    echo "
                    <div class='btn'>
                    <button type='submit' name='editvehicle'><a href='vehicleedit.php'>Edit Vehicle</a></button>
                </div>";
                } else {
                    $edit_error = "<div class='error'><span>After Adding Vehicle Info. Edit Button will appear here.</span></div>";
                }
                ?>
                <?php echo $edit_error;
                ?>
                <div>
                    <div class="btn">
                        <form action="" method="post">
                            <button type="submit" name="unset">Enter Other Code</button>
                        </form>
                        <?php
                        if (isset($_POST['unset'])) {
                            unset($_SESSION['cod']);
                            unset($_SESSION['validCode']);
                            echo "
                            <script>window.location.href = 'host-auction.php';</script>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php } else {
            echo $cod_error;
        } ?>
    </div>
</div>

<?php include './component/footer.php' ?>
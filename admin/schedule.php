<?php include './component/header.php' ?>
<div class="sch-aution">
    <?php include '../db/config.php';
    $msg = $success = $error ='';
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        $showMsg = mysqli_query($conn, "SELECT * FROM `message`
    LEFT JOIN `users` ON `message`.`msg_from_id` = users.user_id  
    LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id` WHERE `message`.`msg_id` = $msg");
        $msg = mysqli_fetch_assoc($showMsg);
    }
    if (isset($_POST['sch_auc'])) {
        $comp_nam = mysqli_real_escape_string($conn, $_POST['comp_nam']);
        $user_nam = mysqli_real_escape_string($conn, $_POST['user_nam']);
        $name = explode(' ', $user_nam);
        $checkCompQ = mysqli_query($conn, "SELECT `comp_id` FROM `company` WHERE `comp_nam` = '$comp_nam'");
        $checkComp = mysqli_fetch_assoc($checkCompQ);
        if ($checkComp['comp_id']) {
            $compid = $checkComp['comp_id'];
            $checkUserQ = mysqli_query($conn, "SELECT `user_id` FROM `users` WHERE `comp_id` = $compid");
            $checkUser = mysqli_fetch_assoc($checkUserQ);
            if ($checkUser['user_id']) {
                $user_id = $checkUser['user_id'];
                $date = mysqli_real_escape_string($conn, $_POST['date']);
                if (isset($_POST['codeval'])) {
                    $code = $_POST['codeval'];
                    sleep(1);
                    $checkCode = mysqli_query($conn, "SELECT `code` FROM `verified_auction` WHERE `code` = '$code'");
                    $codeVerify = mysqli_fetch_row($checkCode);
                    if ($codeVerify == 0) {
                        $insertCode = mysqli_query($conn, "INSERT INTO `verified_auction`(`code`, `user_id`, `code_date`)
                    VALUES ('$code', $user_id, '$date')");
                    
                        sleep(1);
                        $success = "<p class='success'>Auction is Successfully Send..</p>";
                    } else {
                        $error = "<p class='danger'>Following code already exists.Please Try another</p>";
                    }
                } else {
                    $error = "<p class='danger'>please provide code</p>";
                }
            }
        } else {
            $error = "Company Not found";
        }
    }
    echo $error;
    echo $success;
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="sch_auc" method="post">
        <div class="group-data">
            <label>Company Name</label>
            <input type="text" class="control-data" name="comp_nam" value="<?php if (isset($_GET['msg'])) echo $msg['comp_nam'];
                                                                            else echo ''; ?>" required>
        </div>
        <div class="group-data">
            <label>User Name</label>
            <input type="text" class="control-data" name="user_nam" value="<?php if (isset($_GET['msg'])) echo $msg['first_name'] . ' ' . $msg['last_name'];
                                                                            else echo ''; ?>" required>
        </div>
        <div class="group-data">
            <label>Schedule Date</label>
            <input type="date" class="date" name="date" value="<?php if (isset($_GET['msg'])) echo $msg['schedule_date'];
                                                                else echo ''; ?>" required>
        </div>
        <div class="group-data">
            <label>Access Key</label>
            <div class="key" id="key">
            </div>
            <button id="code">Generate Key</button>
        </div>
        <div class="btn">
            <button class="button" name="sch_auc" value="sch_auction">Schedule Auction</button>
        </div>
    </form>
    
</div>
<script>
    $(document).ready(function() {
        $('#code').on('click', function(e) {
            $.ajax({
                url: 'generatekey.php',
                type: 'POST',
                success: function(data) {
                    $('#key').html(data);
                }
            })
            e.preventDefault();
        })
    })
</script>

<?php include './component/footer.php' ?>
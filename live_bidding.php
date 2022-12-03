<?php
// Header File
include './components/header.php';
// Database Config
include './db/config.php';

// Check URL
if (isset($_GET['bid'])) {
    $bidid = $_GET['bid'];
    $_SESSION['bidid'] = $_GET['bid'];
} else {
    echo "<script>
            window.location.href='{$hostname}auction.php';
        </script>";
}

$date = date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$time = date('H:i:s');
$frmttime = date('H:i');

// -------------------------------------- //

$maxAmount = $nextmaxAmount = $vestrtprice = '';
$vepriceQ = mysqli_query($conn, "SELECT `ve_startprice` FROM `vehicles` WHERE ve_id = $bidid AND ve_date = '$date' AND auc_strt_time <= '$frmttime' AND auc_end_time >= '$frmttime'");
if (!mysqli_num_rows($vepriceQ) > 0) {
    echo "<script>
                window.location.href = 'auction.php';
            </script>";
}

$veprice = mysqli_fetch_assoc($vepriceQ);
$vestrtprice = $veprice['ve_startprice'];

$maxbidQ = mysqli_query($conn, "SELECT MAX(bid_amount) as maxbid FROM bidding WHERE ve_id = $bidid");
$maxBid = mysqli_fetch_assoc($maxbidQ);
if ($maxBid['maxbid']) {
    $maxAmount = $maxBid['maxbid'];
} else {
    $maxAmount = $vestrtprice;
}
$nextmaxAmount = intval(($maxAmount * 10) / 100) + $maxAmount;

// ---------------------------------------//

$error = '';

//  Check user Login
if (isset($_SESSION['user'])) {
    if (isset($_POST['livebidbtn'])) {
        $bidvalue = $_POST['bidval'];
        $bidvalue = intval($bidvalue);
        if ($bidvalue >= $maxAmount) {
            $userid = $_SESSION['user'];

            $bivalQ = mysqli_query($conn, "INSERT INTO `bidding`(`user_byerid`, `ve_id`, `bid_amount`, `bid_time`, `bid_date`) 
            VALUES ($userid, $bidid , '$bidvalue' , '$time' , '$date')");
            if ($bivalQ) {
                echo "Bid Successfully Placed";
            } else {
                echo "Bid is not placed";
            }
        } else {
            $error="<div class='bidval-error-cont' id='error'>
                        <div class='bidval-error'>
                            <h2>Sorry <button class='cancel' onclick=popup('error')>X</button></h2>
                            <h3>Your bid value is to low
                            <br>We can't process your bid</h3>
                            <p>Please enter amount greater or equal to high bid</p>
                            <span>Thanks</span>
                        </div>
                    </div>";
        }
    }
} else {
    echo " <script> 
                popup('popup-login');
        </script>";
}

// Gallary Slider
include './components/gal-slider.php';

include './db/config.php';


$compImgQ = "SELECT `comp_img` FROM `vehicles` LEFT JOIN `users` ON `vehicles`.`user_id` = `users`.`user_id` LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id` WHERE ve_id = $bidid";
$compImgQ = mysqli_query($conn, $compImgQ);
$comImg = mysqli_fetch_assoc($compImgQ);
    echo"<div class='comp-img'>
            <img src='$COMP_IMAGE_PATH.$comImg[comp_img]'>
        </div>";
?>

<!-- livebid Button Start -->
<div class='livebid'>
<button name='strtp' class='strtp'>RS <?php echo $vestrtprice ?></button>
<?php
echo "<button id='maxbid'>{$maxAmount}</button>
    <button id='nextmaxbid'>{$nextmaxAmount}</button>";
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?bid=' . $bidid; ?>" method="post">
    <input name='bidval' id="bidval" placeholder='Custom Amount' required>
    <button type='submit' id="livebidbtn" name='livebidbtn'>Place the Bid</button>
    <?php echo "<div style='color: red; font-size: .9rem; background-color: #fff;'>{$error}</div>"; ?>
</form>
</div><!-- livebid Button END -->

</div><!-- auc-comp END-->
</div><!-- auct-detail END-->


<style>
    .bidval-error-cont {
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(196, 196, 196, 0.65);
        z-index: 10;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .bidval-error-cont .bidval-error {
        background-color: var(--color-white);
        width: 300px;
        padding: 2rem 1rem;
        border-radius: 5px;
    }

    .bidval-error-cont .bidval-error h2 {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        color: red;
    }

    .bidval-error-cont .bidval-error h2 button {
        border: none;
        background: none;
        font-weight: 600;
        font-size: 1.1rem;
        outline: none;
        color: var(--color-grey3);
        padding: 0;
    }

    .bidval-error-cont .bidval-error h2 button:hover {
        color: var(--color-secondary);
    }

    .bidval-error-cont .bidval-error h3 {
        padding: .7rem 0;
        color: var(--color-secondary);
    }

    .bidval-error-cont .bidval-error p {
        font-size: 1rem;
        font-weight: bold;
        padding: .3rem 0;
    }

    .bidval-error-cont .bidval-error span {
        font-weight: bold;
        width: 100%;
        display: block;
        text-align: right;
        padding-top: 2rem;
        color: var(--color-secondary);
    }
</style>

<div class="live-bid" id="livebids">
    <!-- Bidding Diplay Here -->

    <?php
    // To Send Data to Load Bid Page
    $bidstrtp = $veprice['ve_startprice'];
    ?>
    <input hidden type="text" value="<?php echo $bidstrtp ?>" id="bidstrtp">
    <input hidden type="text" id="bidvale" value="<?php echo $bidid ?>">
</div>


<script src="assets/js/livebid.js"></script>
<script>
    var bid = $('#bidvale').val();
    var bidstrtp = $('#bidstrtp').val();

    $(document).ready(function() {
        function liveBidding(bid, bidstrtp) {
            $.ajax({
                url: 'livebids.php',
                type: 'POST',
                data: {
                    bid: bid,
                    bidstrtp: bidstrtp,
                },
                success: function(sdata) {
                    $('#livebids').html(sdata);
                }
            })

        }
        liveBidding(bid, bidstrtp);
        setInterval(
            (function() {
                liveBidding(bid, bidstrtp);
            }), 5000);

    })
    $('#error').on('click', () => {
        $('#error').css('display', 'none');
    })
</script>
<?php include './components/footer.php' ?>
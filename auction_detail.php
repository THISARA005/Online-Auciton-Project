<?php
// Header File Included
include './components/header.php';
// DataBase Config File
include 'db/config.php';

// Check URL
$bidid = '';
if (isset($_GET['id'])) {
    $bidid = $_GET['id'];
    $_SESSION['bidid'] = $bidid;
} else {
    header("Location: {$hostname}auction.php");
}

// Gallary Slider File
include './components/gal-slider.php';
include 'db/config.php';
$selectAuctDtl = "SELECT `company`.`comp_img`, `vehicles`.`auc_strt_time`, `vehicles`.`auc_end_time`, `vehicles`.`ve_date` FROM `vehicles` LEFT JOIN `users` ON `vehicles`.`user_id` = `users`.`user_id` LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id` WHERE ve_id = $bidid";
$auctdtlQuery = mysqli_query($conn, $selectAuctDtl);
if (!mysqli_num_rows($auctdtlQuery) > 0) {
    echo "
    <script>
        window.location.href = 'auction.php';
    </script>";
}
$date = date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$time = mysqli_fetch_assoc($auctdtlQuery);
?>
<div class="comp-img">
    <img src="<?php echo $COMP_IMAGE_PATH . $time['comp_img'] ?>" alt="">
</div>

<!-- ------------- Detail of Auction ------------------- -->
<!-- Gallary side bar Start -->
<div class="bid">
    <?php
    if (mysqli_num_rows($auctdtlQuery) > 0) {
        $nowTime = date('H:i');
        $strt = $time['auc_strt_time'];
        $end = $time['auc_end_time'];
        $strt = date('H:i', strtotime($strt));
        $end = date('H:i', strtotime($end));
        $biddate = $time['ve_date'];
        echo "<h4>Bid Date : <span>{$biddate}</span></h4>
                <h4>Bid Start Time : <span>{$strt}</span></h4>
                <h4>Bid End Time : <span>{$end}</span></h4>
                ";
        if ($strt <= $nowTime && $end >= $nowTime && $biddate == $date) {
            echo "You can bid Now";
            echo "<div class='btn'><button><a href='live_bidding.php?bid={$bidid}'>Proceed to Bid</a></button></div>";
        } else {
            echo "<span style='color: red; font-weight: bold;'>Bidding Not Start Yet</span>";
        }
    }
    ?>
</div><!-- Gallary side bar END-->

</div><!-- auc-comp END-->
</div><!-- auct-detail END-->

<!-- Details Table Section Start -->
<div class="detail-con">
    <?php
    $auctionDtlQ = mysqli_query($conn, "SELECT * FROM `vehicles`
    LEFT JOIN `make` ON vehicles.ve_makeid = make.make_id
    LEFT JOIN `bodystyle` ON vehicles.ve_typeid = bodystyle.bodyst_id
    LEFT JOIN `condition` ON vehicles.ve_conditionid = condition.cond_id
    LEFT JOIN `transmission` ON vehicles.ve_transmissionid = transmission.trans_id
    LEFT JOIN `fuel_type` ON vehicles.ve_fueltypeid = fuel_type.fuel_id
    WHERE ve_id = $bidid");
    $auctionDtl = mysqli_fetch_assoc($auctionDtlQ);
    mysqli_close($conn);
    ?>
    <div class="detail">
        <table>
            <tr>
                <th>Name</th>
                <th>Properties</th>
            </tr>
            <tr>
                <td>Branch</td>
                <td><?php echo $auctionDtl['make_nam'] ?></td>
            </tr>
            <tr>
                <td>Type</td>
                <td><?php echo $auctionDtl['body_style'] ?></td>
            </tr>
            <tr>
                <td>Model</td>
                <td><?php echo $auctionDtl['ve_modelid'] ?></td>
            </tr>
            <tr>
                <td>Color</td>
                <td><?php echo $auctionDtl['ve_colorid'] ?></td>
            </tr>
            <tr>
                <td>Year of Manufacture</td>
                <td><?php echo $auctionDtl['ve_year'] ?></td>
            </tr>
            <tr>
                <td>Condition</td>
                <td><?php echo $auctionDtl['ve_condition'] ?></td>
            </tr>
            <tr>
                <td>Transmission</td>
                <td><?php echo $auctionDtl['trans_type'] ?></td>
            </tr>
            <tr>
                <td>Capacity</td>
                <td><?php echo $auctionDtl['ve_encapacity'] ?></td>
            </tr>
            <tr>
                <td>Mileage</td>
                <td><?php echo $auctionDtl['ve_mileage'] ?></td>
            </tr>
            <tr>
                <td>Fuel Type</td>
                <td><?php echo $auctionDtl['fuel_type'] ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $auctionDtl['ve_desc'] ?></td>
            </tr>
        </table>
    </div>
    <div class="price">
        <span>Rs : <?php echo $auctionDtl['ve_startprice'] ?></span>
    </div>
</div>
<!-- Details Table Section END -->


<?php include './components/footer.php';  //Footer File
?>
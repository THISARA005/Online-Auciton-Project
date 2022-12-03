<div class="ongoing-cont" id="upcoming-auction">
    <?php
    include 'db/config.php';

    $date = date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d');
    $time = date('H:i');

    $selectOn = "SELECT  auc_strt_time , auc_end_time, ve_img , `company`.`comp_nam` FROM `vehicles` 
        LEFT JOIN `users` ON `vehicles`.`user_id` = `users`.`user_id`
        LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id`
        WHERE `ve_date` = '$date' AND `auc_strt_time` <= '$time' AND `auc_end_time` > '$time'";

    $onGoing = mysqli_query($conn, $selectOn);
    if (mysqli_num_rows($onGoing) > 0) {
        while ($onGoingData = mysqli_fetch_assoc($onGoing)) {
    ?>
            <div class="ongoing-auct">
                <div class="ongoing-img">
                    <div class="img-bg-layer">
                        <div class="img-con">
                            <img src="uploaded/vehiclesImg/<?php $onExplode = explode(',', $onGoingData['ve_img']);
                                                            echo $onimg = $onExplode[0]; ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <h3>OnGoing Auction</h3>
                    <div class="visit">
                        <h4><a href="">Visit the ongoing auctions</a></h4>
                        <p>Auction Started Time : <span><?php echo $onGoingData['auc_strt_time']; ?></span></p>
                        <p>Auction End Time : <span><?php echo $onGoingData['auc_end_time']; ?></span></p>
                        <p>Auction Host : <span><?php echo $onGoingData['comp_nam']; ?></span></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="right-icon-btn">
            <button onclick="nextOngoing()"><i class="fas fa-angle-right"></i></button>
        </div>
    <?php } else { ?>
        <div class="ongoing-auct">
            <div class="ongoing-img">
                <div class="img-bg-layer">
                    <div class="img-con">
                        <img src="assets/img/car3.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="detail">
                <h3>OnGoing Auction</h3>
                <div class="visit">
                    <h4><a href="">Visit the ongoing auctions</a></h4>
                    <p>Auction Started Time : <span>00:00:am</span></p>
                    <p>Auction End Time : <span>00:00pm</span></p>
                    <p>Auction Host : <span>...........</span></p>
                </div>
            </div>
        </div>
        <div class="right-icon-btn">
            <button onclick="nextOngoing()"><i class="fas fa-angle-right"></i></button>
        </div>
    <?php } ?>
</div>

<div class="upcoming-cont">
    <div class="left-icon-btn">
        <button onclick="nextUpcoming()"><i class="fas fa-angle-left"></i></button>
    </div>
    <?php
    $selectUp = "SELECT auc_strt_time , auc_end_time, ve_img, ve_date , `company`.`comp_nam` FROM `vehicles` 
LEFT JOIN `users` ON `vehicles`.`user_id` = `users`.`user_id`
LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id`
WHERE `ve_date` > '$date'";
    $upComing = mysqli_query($conn, $selectUp);
    if (mysqli_num_rows($upComing) > 0) {
        while ($upComingData = mysqli_fetch_assoc($upComing)) { ?>
            <div class="upcoming-auct">
                <div class="detail">
                    <h3>ABC</h3>
                    <div class="visit">
                        <h4>Check Out The Upcoming Auctions</h4>

                        <p>Auction Date : <span><?php $update = date_create($upComingData['ve_date']);
                                                echo date_format($update, "Y-M-d"); ?></span></p>
                        <p>Auction Started Time : <span><?php echo $upComingData['auc_strt_time']; ?></span></p>
                        <p>Auction End Time : <span><?php echo $upComingData['auc_end_time']; ?></span></p>
                        <p>Auction Host : <span><?php echo $upComingData['comp_nam']; ?></span></p>
                    </div>
                </div>
                <div class="upcoming-img">
                    <div class="img-bg-layer">
                        <?php $upExplode = explode(',', $upComingData['ve_img']);
                        $upimg = $upExplode[0]; ?>
                        <div class="img-con">
                            <img src="<?php echo $VEHICLE_IMAGE_PATH . $upimg ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } else {
        ?>
        <div class="left-icon-btn">
            <button onclick="nextUpcoming()"> <i class="fas fa-angle-left"></i> </button>
        </div>
        <div class="upcoming-auct">
            <div class="detail">
                <h3>ABC</h3>
                <div class="visit">
                    <h4>Check Out The Upcoming Auctions</h4>

                    <p>Auction Date : <span>0000-00-00</span></p>
                    <p>Auction Started Time : <span>00:00am</span></p>
                    <p>Auction End Time : <span>00:00pm</span></p>
                    <p>Auction Host : <span>.........</span></p>
                </div>
            </div>
            <div class="upcoming-img">
                <div class="img-bg-layer">
                    <div class="img-con">
                        <img src="<?php echo $VEHICLE_TEMP_IMAGE_PATH ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script src="./assets/js/auct.js"></script>
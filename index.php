<?php
// Header File
include './components/header.php';

// Slider File
include './components/slider.php'
?>

<div class="main-container" id="about">

    <!-- ----------- Import File upcoming-auction.php  -------------- -->
    <?php include './upcoming-auction.php' ?>

<!-- ------------- WHY Choose STRT ------------ -->

    <section class="choose">
        <div class="choose-left">
            <div class="heading">
                <h3>WHY CHOOSE US?</h3>
            </div>
            <div class="choose-detail">
                <div class="detail">
                    <div class="icon">
                        <i class="far fa-clock fa-2x"></i>
                    </div>
                    <div class="content">
                        <h4>Friendly Service</h4>
                        <p>we promise to stand aside when you are facing difficulties</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="icon">
                        <i class="far fa-clock fa-2x"></i>
                    </div>
                    <div class="content">
                        <h4>Friendly Service</h4>
                        <p>we promise to stand aside when you are facing difficulties</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="icon">
                        <i class="far fa-clock fa-2x"></i>
                    </div>
                    <div class="content">
                        <h4>Friendly Service</h4>
                        <p>we promise to stand aside when you are facing difficulties</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="icon">
                        <i class="far fa-clock fa-2x"></i>
                    </div>
                    <div class="content">
                        <h4>Friendly Service</h4>
                        <p>we promise to stand aside when you are facing difficulties</p>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'db/config.php'; ?>
        <div class="choose-right">
            <div class="img-bg-layer">
                <div class="img-con">
                    <img src="<?php echo $CHOOSE_IMAGE_PATH ?>" alt="">
                </div>
            </div>
        </div>
    </section>
<!-- ------------- WHY Choose END ------------ -->


<!-- ------------- Client Start ------------ -->
    <section class="client">
        <div class="heading">
            <h3>OUR CLIENTS</h3>
        </div>
        <div class="slider">
            <?php
            $clientQ = mysqli_query($conn, "SELECT client_img FROM `client`");
            if (mysqli_num_rows($clientQ) > 0) {
                while ($client = mysqli_fetch_assoc($clientQ)) {
            ?>
                    <div class="client-logo">
                        <img src="<?php echo $CLIENT_IMAGE_PATH . $client['client_img'] ?>" alt="">
                    </div>
                <?php }
            } else { ?>
                <div class="client-logo">
                    <img src="<?php echo $CLIENT_TEMP_IMAGE_PATH ?>" alt="">
                </div>
            <?php }
            mysqli_close($conn);
            ?>
        </div>
    </section>
<!-- ------------- Client END ------------ -->

</div> <!-- Main Container END -->

<?php include './components/footer.php'; ?>
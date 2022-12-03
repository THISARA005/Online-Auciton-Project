<?php include './component/header.php' ?>

<div class="overview">
    <?php
    include "db/config.php";
    $byerResult = mysqli_query($conn, "SELECT COUNT(user_id) as totalByer from users WHERE user_type = 'buyer'");
    $byerData = mysqli_fetch_assoc($byerResult);

    $sellerResult = mysqli_query($conn, "SELECT COUNT(user_id) as totalSeller from users WHERE user_type = 'seller'");
    $sellerData = mysqli_fetch_assoc($sellerResult);

    $aucResult = mysqli_query($conn, "SELECT COUNT(ve_id) as totalAuction from vehicles");
    $aucData = mysqli_fetch_assoc($aucResult);

    ?>
    <div class="stat">
        <div class="stat-anim">
            <div class="stat-data stat-seller">
                <span class="nam">Sellers</span>
                <span class="val"><?php echo $sellerData['totalSeller'] ?></span>
            </div>
        </div>
        <div class="stat-anim">
            <div class="stat-data stat-buyer">
                <span class="nam">Buyers</span>
                <span class="val"><?php echo $byerData['totalByer'] ?></span>
            </div>
        </div>
        <div class="stat-anim">
            <div class="stat-data auction">
                <span class="nam">Auctions</span>
                <span class="val"><?php echo $aucData['totalAuction'] ?></span>
            </div>
        </div>
    </div>
    <?php include 'auction_chart.php' ?>
</div>
<script>
    $(document).ready(function() {
        function loadBuyer(bpage) {
            $.ajax({
                url: 'buyer_page.php',
                type: 'POST',
                data: {
                    page_b: bpage
                },
                success: function(bdata) {
                    $('#buyer').html(bdata);
                }
            })
        }
        loadBuyer();

        //Buyer pagination
        $(document).on("click", "#pagination a", function(e) {
            e.preventDefault();
            var bpage_id = $(this).attr("id");
            loadBuyer(bpage_id);
        })
    })
</script>

<?php include './component/footer.php' ?>
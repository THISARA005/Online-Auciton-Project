<?php include './component/header.php' ?>
<div class="overview">
    <?php

    include '../db/config.php';
    $id = $_SESSION['se_userid'];
    $seVehicle = mysqli_query($conn, "SELECT COUNT($id) as total  FROM `vehicles` WHERE `user_id` = $id") or die('query failed');
    $vehicles = mysqli_fetch_assoc($seVehicle);

    $seVehicleSold = mysqli_query($conn, "SELECT COUNT($id) as sold FROM `vehicles`  WHERE `user_id` = $id AND `ve_status` = 1");
    $sold = mysqli_fetch_assoc($seVehicleSold);

    $seVehicleUnsold = mysqli_query($conn, "SELECT COUNT($id) as unsold FROM `vehicles` WHERE `user_id` = $id AND `ve_status` = 0");
    $unsold = mysqli_fetch_assoc($seVehicleUnsold);


    ?>
    <div class="stat">
        <div class="stat-anim">
            <div class="stat-data stat-seller">
                <span class="nam">Total Auction</span>
                <span class="val"><?php echo $vehicles['total'] ?></span>
            </div>
        </div>
        <div class="stat-anim">
            <div class="stat-data stat-buyer">
                <span class="nam">Sold</span>
                <span class="val"><?php echo $sold['sold'] ?></span>
            </div>
        </div>
        <div class="stat-anim">
            <div class="stat-data auction">
                <span class="nam">UnSold</span>
                <span class="val"><?php echo $unsold['unsold'] ?></span>
            </div>
        </div>
    </div> <!-- Stat div END -->

    <div class="chart">
        <?php
        $limitAuction = 7;
        if (isset($_GET['page'])) {
            $auctionPage = $_GET['page'];
        } else {
            $auctionPage = 1;
        }

        $auctionOffset = ($auctionPage - 1) * $limitAuction;
        $selectQuery = "SELECT * FROM `vehicles` 
        LEFT JOIN `users` ON vehicles.user_id = users.user_id 
        LEFT JOIN `make` ON vehicles.ve_makeid = make.make_id
        LEFT JOIN `bodystyle` ON vehicles.ve_typeid = bodystyle.bodyst_id
        LEFT JOIN `fuel_type` ON vehicles.ve_fueltypeid = fuel_type.fuel_id
        WHERE vehicles.user_id = $id
        ORDER BY vehicles.ve_id DESC LIMIT {$auctionOffset} , {$limitAuction}";

        $selectOverview = mysqli_query($conn, $selectQuery) or die('query failed');
        if (mysqli_num_rows($selectOverview) > 0) { ?>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Make</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Date</th>
                    <th>Buyer</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
                <?php
                while ($overview = mysqli_fetch_assoc($selectOverview)) {
                    $status = $veprice = $buyername = '';
                    if ($overview['ve_status'] == 1) {
                        $veidQ = mysqli_query($conn, "SELECT bid_amount, ve_id, user_byerid FROM `bidding` WHERE ve_id = $overview[ve_id] ORDER BY bid_amount DESC LIMIT 1");
                        if(mysqli_num_rows($veidQ)>0){
                            $veid = mysqli_fetch_assoc($veidQ);
                        $buyeridQ = mysqli_query($conn, "SELECT `first_name`, `last_name` FROM `users` WHERE `user_id` = $veid[user_byerid]");
                        $buyerid = mysqli_fetch_assoc($buyeridQ);
                        $buyername = $buyerid['first_name'].' '.$buyerid['last_name'];
                        $veprice = $veid['bid_amount'];
                        $status = 'sold';
                        }
                    } else {
                        $status = 'unsold';
                        $veprice = $overview['ve_startprice'];
                        $buyername = '_ _ _';
                    }
                    echo "<tr>
                    <td> {$overview['ve_code']} </td>
                    <td> {$overview['make_nam']} </td>
                    <td> {$overview['body_style']} </td>
                    <td> {$overview['ve_modelid']} </td>
                    <td> {$overview['ve_date']} </td>
                    <td> {$buyername} </td>
                    <td> {$veprice} </td>
                    <td> {$status} </td>
                    </tr>";
                }
                ?>
            </table>
        <?php } else {
            echo "<h3 style='color: red'>No Record Found !</h3>";
        }
        ?>
    </div><!-- Chart div END -->

    <div class="pagination">
        <?php $arrowLeft = '';
        if ($auctionPage == 1) {
            $arrowLeft = 'hidden';
        }
        echo "<div style='visibility : {$arrowLeft};' class='btn-format l-arow-pos'>
            <a href='overview.php?page=" . intval($auctionPage - 1) . "'>Prev <i class='fas fa-angle-left'></i></a>
        </div>";
        ?>
        <ul>
            <?php
            $pageQuery = "SELECT ve_id FROM `vehicles` WHERE `user_id` = 85";
            $pageQueryResult = mysqli_query($conn, $pageQuery);
            $totalAuction = mysqli_num_rows($pageQueryResult);
            $totalAuctionPage = ceil($totalAuction / $limitAuction);
            for ($i = 1; $i <= $totalAuctionPage; $i++) {
                if ($i == $auctionPage) {
                    $activePage = 'active';
                } else {
                    $activePage = '';
                }
                echo "<li><a class='$activePage' href='overview.php?page={$i}'>{$i}</a></li>";
            }
            ?>
        </ul>
        <?php $arrowRight = '';
        if ($auctionPage == $totalAuctionPage) {
            $arrowRight = 'hidden';
        }
        echo "<div style='visibility : {$arrowRight};' class='btn-format r-arow-pos'>
            <a href='overview.php?page=" . intval($auctionPage + 1) . "'>Next <i class='fas fa-angle-right'></i></a>
        </div>";
        ?>
    </div><!-- Pagination div END -->
</div>

<?php include './component/footer.php' ?>
<?php include './component/header.php' ?>
<div class="overview">
    <?php
    include '../db/config.php';
    $date = date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d');
    $time = date('H:i');
    $ongoingQ = mysqli_query($conn, "SELECT COUNT(ve_id) as ongoing  FROM `vehicles` WHERE ve_date = '$date' AND auc_strt_time <= '$time' AND auc_end_time > '$time'") or die('query failed');
    $onGoing = mysqli_fetch_assoc($ongoingQ);

    ?>
    <div class="stat">
        <div class="stat-anim">
            <div class="stat-data stat-buyer">
                <span class="nam">Ongoing Auction</span>
                <span class="val"><?php echo $onGoing['ongoing'] ?></span>
            </div>
        </div>
    </div>
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
        WHERE ve_date = '$date' AND auc_strt_time <= '$time' AND auc_end_time > '$time'
        ORDER BY vehicles.ve_date DESC LIMIT {$auctionOffset} , {$limitAuction}";
        $selectOverview = mysqli_query($conn, $selectQuery) or die('query failed');
        if (mysqli_num_rows($selectOverview) > 0) { ?>
            <table>
                <tr>
                    <th>Make</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                <?php
                while ($overview = mysqli_fetch_assoc($selectOverview)) {
                    echo "<tr>
                    <td> {$overview['make_nam']} </td>
                    <td> {$overview['body_style']} </td>
                    <td> {$overview['ve_modelid']} </td>
                    <td> {$overview['ve_date']} </td>
                    <td> {$overview['ve_startprice']} </td>
                    <td> {$overview['auc_strt_time']} </td>
                    <td> {$overview['auc_end_time']} </td>
                    </tr>";
                }
                ?>
            </table>
        <?php } else {
             echo "<h3 style='color: red'>No Record Found !</h3>";
        }
        ?>
    </div>
    <div class="pagination">
    <?php $arrowLeft = '';
        if ($auctionPage == 1) {
            $arrowLeft = 'hidden';
        }
        echo "<div style='visibility : {$arrowLeft};' class='btn-format l-arow-pos'>
                <a href='ongoing-auction.php?page=" . intval($auctionPage - 1) . "'>Prev <i class='fas fa-angle-left'></i></a>
            </div>";
        ?>
        <ul>
            <?php
            $pageQuery = "SELECT ve_id FROM `vehicles` WHERE ve_date = '$date' AND auc_strt_time <= '$time' AND auc_end_time > '$time'";
            $pageQueryResult = mysqli_query($conn, $pageQuery);
            $totalAuction = mysqli_num_rows($pageQueryResult);
            $totalAuctionPage = ceil($totalAuction / $limitAuction);
            for ($i = 1; $i <= $totalAuctionPage; $i++) {
                if ($i == $auctionPage) {
                    $activePage = 'active';
                } else {
                    $activePage = '';
                }
                echo "<li><a class='$activePage' href='ongoing-auction.php?page={$i}'>{$i}</a></li>";
            }
            ?>
        </ul>
        <?php $arrowRight = '';
        if ($auctionPage == $totalAuctionPage) {
            $arrowRight = 'hidden';
        }
        echo "<div style='visibility : {$arrowRight};' class='btn-format r-arow-pos'>
                <a href='ongoing-auction.php?page=" . intval($auctionPage + 1) . "'>Next <i class='fas fa-angle-right'></i></a>
            </div>";
        ?>
    </div>
</div>

<?php include './component/footer.php' ?>
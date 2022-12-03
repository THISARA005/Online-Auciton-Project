<?php include './component/header.php' ?>
<div class="overview">
    <?php
    include '../db/config.php';
    $buid = $_SESSION['bu_userid'];
    $buyedQ = mysqli_query($conn, "SELECT COUNT($buid) as total  FROM `sold` WHERE `buyer_id` = $buid") or die('query failed');
    $buyed = mysqli_fetch_assoc($buyedQ);
    ?>
    <div class="stat">
        <div class="stat-anim">
            <div class="stat-data stat-seller">
                <span class="nam">Total Buyed</span>
                <span class="val"><?php echo $buyed['total'] ?></span>
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
        $selectQuery = "SELECT * FROM `sold`
        LEFT JOIN `vehicles` ON sold.ve_id = vehicles.ve_id 
        LEFT JOIN `make` ON vehicles.ve_makeid = make.make_id
        LEFT JOIN `bodystyle` ON vehicles.ve_typeid = bodystyle.bodyst_id
        LEFT JOIN `fuel_type` ON vehicles.ve_fueltypeid = fuel_type.fuel_id
        WHERE sold.buyer_id = $buid
        ORDER BY sold.sold_id DESC LIMIT {$auctionOffset} , {$limitAuction}";

        $selectOverview = mysqli_query($conn, $selectQuery) or die('query failed');

        if (mysqli_num_rows($selectOverview) > 0) { ?>
            <table>
                <tr>
                    <th>Make</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Date</th>
                    <th>Start Price</th>
                    <th>buyed Price</th>
                </tr>
                <?php
                while ($overview = mysqli_fetch_assoc($selectOverview)) {
                    echo "<tr>
                    <td> {$overview['make_nam']} </td>
                    <td> {$overview['body_style']} </td>
                    <td> {$overview['ve_modelid']} </td>
                    <td> {$overview['ve_date']} </td>
                    <td> {$overview['ve_startprice']} </td>
                    <td> {$overview['price']} </td>
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
            <a href='overview.php?page=" . intval($auctionPage - 1) . "'>Prev <i class='fas fa-angle-left'></i></a>
        </div>";
        ?>
        <ul>
            <?php
            $pageQuery = "SELECT sold_id FROM `sold` WHERE `buyer_id` = $buid";
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
    </div>
</div>

<?php include './component/footer.php' ?>
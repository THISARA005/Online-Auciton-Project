<?php
// Header File
include './components/header.php';
// Slider File
include './components/slider.php';
?>

<div class="auction-page">
    <!-- Auction Start -->
    <div class="auction-cont">
        <!-- <div class="sort-auc">
            <div class="auction-result">
                <h3>15 Result Found</h3>
            </div>
            <div class="sorting-auc">
                <div class="sort-order">
                    <form method="get">
                        <select name="Order" id="order-auct">
                            <option selected disabled value="DESC">Sorted By</option>
                            <option value="ASC">Ascending Order</option>
                            <option value="DESC">Decending Order</option>
                        </select>
                    </form>
                </div>
                <div class="grid-list">
                    <i class="fas fa-list-ul"></i>
                    <i class="fas fa-th"></i>
                </div>
            </div>
        </div> -->

        <div class="auction">
            <?php
            // DataBase Config File
            include 'db/config.php';
            $limitAuction = 9; // limit query

            // Check URL
            if (isset($_GET['page'])) {
                $auctionPage = $_GET['page'];
            } else {
                $auctionPage = 1;
            }

            $and = '';
            $auctionOffset = ($auctionPage - 1) * $limitAuction;
            $date = date_default_timezone_set('Asia/Colombo');
            $date = date('Y-m-d');
            $time = date('H:i');
            $where = " WHERE";
            $refer = '';
            $and = " 1 AND ve_date >= '$date'";

            $filterAuction = "SELECT * FROM `vehicles` 
            LEFT JOIN `make` ON vehicles.ve_makeid = make.make_id
            LEFT JOIN `bodystyle` ON vehicles.ve_typeid = bodystyle.bodyst_id
            LEFT JOIN `fuel_type` ON vehicles.ve_fueltypeid = fuel_type.fuel_id";
            $filOrder = " ORDER BY vehicles.ve_date ASC LIMIT {$auctionOffset} , {$limitAuction}";

            if (isset($_GET['filter_auct'])) { // If True Filtered Query Run
                $refer =  $_SERVER["REQUEST_URI"];

                if (isset($_GET['ve_make'])) {
                    $filmake = $_GET['ve_make'];
                    $and .= " AND `ve_makeid` = $filmake";
                }
                if (isset($_GET['ve_model'])) {
                    $filmodel = $_GET['ve_model'];
                    $and .= " AND `ve_modelid` = '$filmodel'";
                }
                if (isset($_GET['ve_type'])) {
                    $filtype = $_GET['ve_type'];
                    $and .= " AND `ve_typeid` = $filtype";
                }
                if (isset($_GET['input-min'])) {
                    $filminPrice = $_GET['input-min'];
                    $filmaxPrice = $_GET['input-max'];
                    $and .= " AND `ve_startprice` >= $filminPrice AND `ve_startprice` <= $filmaxPrice";
                }
                if (isset($_GET['ve_color'])) {
                    $filcolor = $_GET['ve_color'];
                    $and .= " AND `ve_colorid` = '$filcolor'";
                }
                $filterAuctionQ = $filterAuction . '' . $where . '' . $and . '' . $filOrder;

                $filterQ = mysqli_query($conn, $filterAuctionQ);
                $counter = 0;
                if (mysqli_num_rows($filterQ) > 0) {
                    while ($filter = mysqli_fetch_assoc($filterQ)) {
                        $explodeImg = explode(',', $filter['ve_img']);
            ?>
                        <div class="auction-disp" onclick='() => <a href="auction_detail.php?id=<?php echo $filter["ve_id"]; ?>"></a>'>
                            <div class="auc-img">
                                <a href="auction_detail.php?id=<?php echo $filter["ve_id"]; ?>"><img src="<?php echo $VEHICLE_IMAGE_PATH . $explodeImg['0'] ?>" alt=""></a>
                            </div>
                            <div class="auc-detail">
                                <div class="auc-heading">
                                    <div class="auc-text">
                                        <h4><?php echo $filter['make_nam'] ?> | <?php echo $filter['ve_modelid'] ?><span><?php echo $filter['ve_year'] ?></span></h4>
                                    </div>
                                    <div class="auc-price"><span>Rs <?php echo $filter['ve_startprice'] ?>Mn</span></div>
                                </div>
                                <?php
                                $string = strip_tags($filter['ve_desc']);
                                if (strlen($string) > 100) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 100);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= "... <a href='auction_detail.php?id={$filter['ve_id']}'>Read More</a>";
                                } else {
                                    $string .= "... <a href='auction_detail.php?id={$filter['ve_id']}'>Read More</a>";
                                }

                                ?>
                                <div class="auc-para">
                                    <p><?php echo $string; ?></p>
                                </div>
                                <div class="auc-icon">
                                    <div class="icon">
                                        <i class="fas fa-gas-pump"></i>
                                        <span><?php echo $filter['fuel_type'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-car"></i>
                                        <span><?php echo $filter['body_style'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-tachometer-alt-fast"></i>
                                        <span><?php echo $filter['ve_mileage'] ?>KM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo "<h3 style='color: red'>No Record Found !</h3>";
                }
            } else { // If False Normal Query Run

                $refer = $_SERVER['PHP_SELF'] . '?';

                $filterAuctionQ = $filterAuction . '' . $where . '' . $and . '' . $filOrder;
                $filterQ = mysqli_query($conn, $filterAuctionQ);
                
                if (mysqli_num_rows($filterQ) > 0) {
                    while ($filter = mysqli_fetch_assoc($filterQ)) {
                        $explodeImg = explode(',', $filter['ve_img']);
                    ?>
                        <div class="auction-disp">
                            <div class="auc-img">
                                <a href="auction_detail.php?id=<?php echo $filter["ve_id"]; ?>"><img src="<?php echo $VEHICLE_IMAGE_PATH . $explodeImg['0'] ?>" alt=""></a>
                            </div>
                            <div class="auc-detail">
                                <div class="auc-heading">
                                    <div class="auc-text">
                                        <h4><?php echo $filter['make_nam'] ?> | <?php echo $filter['ve_modelid'] ?><span><?php echo $filter['ve_year'] ?></span></h4>
                                    </div>
                                    <div class="auc-price"><span>Rs <?php echo $filter['ve_startprice'] ?>Mn</span></div>
                                </div>
                                <?php
                                $string = strip_tags($filter['ve_desc']);
                                if (strlen($string) > 100) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 100);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= "... <a href='auction_detail.php?id={$filter['ve_id']}'>Read More</a>";
                                } else {
                                    $string .= "... <a href='auction_detail.php?id={$filter['ve_id']}'>Read More</a>";
                                }

                                ?>
                                <div class="auc-para">
                                    <p><?php echo $string; ?></p>
                                </div>
                                <div class="auc-icon">
                                    <div class="icon">
                                        <i class="fas fa-gas-pump"></i>
                                        <span><?php echo $filter['fuel_type'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-car"></i>
                                        <span><?php echo $filter['body_style'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-tachometer-alt-fast"></i>
                                        <span><?php echo $filter['ve_mileage'] ?>KM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php }
                } else {
                    echo "<h3 style='color: red'>No Record Found !</h3>";
                }
            }

            ?>
        </div>
    </div>
    <!-- Auction END -->

    <!--  Filter Section Start -->
    <div class="auction-filter">
        <div class="search-heading">
            <h4>Refine Your Search</h4>
        </div>
        <form class="auc-search" action="" id="filterform" method="GET">
            <div class="search-item">
                <select name="ve_make" required>
                    <option selected disabled>Select Make</option>
                    <?php
                    $selectMake = "SELECT * FROM `make`";
                    $makeResult = mysqli_query($conn, $selectMake) or die(' Make Query Failed');
                    if (mysqli_num_rows($makeResult) > 0) {
                        while ($make = mysqli_fetch_assoc($makeResult)) {
                            echo "<option value='{$make['make_id']}'>{$make['make_nam']}</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="search-item">
                <select name="ve_model" required>
                    <option selected disabled>Select Model</option>
                    <?php
                    $selectModel = "SELECT DISTINCT `ve_modelid` FROM `vehicles`";
                    $modelResult = mysqli_query($conn, $selectModel) or die(' Model Query Failed');
                    if (mysqli_num_rows($modelResult) > 0) {
                        while ($model = mysqli_fetch_assoc($modelResult)) {
                            echo "<option value='{$model['ve_modelid']}'>{$model['ve_modelid']}</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="search-item">
                <select name="ve_type" required>
                    <option selected disabled>Select Type</option>
                    <?php $selectType = "SELECT * FROM `bodystyle`";
                    $typeResult = mysqli_query($conn, $selectType) or die('Type Query Failed');
                    if (mysqli_num_rows($typeResult) > 0) {
                        while ($type = mysqli_fetch_assoc($typeResult)) {
                            echo "<option value='{$type['bodyst_id']}'>{$type['body_style']}</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="search-range">
                <div class="price-input">
                    <div class="field">
                        <span>Min</span>
                        <input type="number" name="input-min" class="input-min" id="val" value="2500000">
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <span>Max</span>
                        <input type="number" name="input-max" class="input-max" value="7500000">
                    </div>
                </div>
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <div class="range-input">
                    <input type="range" class="range-min" min="0" max="10000000" value="2500000" step="1000">
                    <input type="range" class="range-max" min="0" max="10000000" value="7500000" step="1000">
                </div>
            </div>
            <div class="search-item">
                <select name="ve_color" required>
                    <option selected disabled>Select Color</option>
                    <?php $selectColor = "SELECT DISTINCT `ve_colorid` FROM vehicles";
                    $colorResult = mysqli_query($conn, $selectColor) or die('CoLor Query Failed');
                    if (mysqli_num_rows($colorResult) > 0) {
                        while ($color = mysqli_fetch_assoc($colorResult)) {
                            echo "<option value='{$color['ve_colorid']}'>{$color['ve_colorid']}</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="button">
                <input type="submit" value="Search Now" id="none" name="filter_auct">
                <i class="fas fa-search"></i>
            </div>
        </form>
    </div>
    <!--  Filter Section END -->

    <!--  Pagination Section Start -->
    <div class="pagination">
        <?php $arrowLeft = '';
        if ($auctionPage == 1) {
            $arrowLeft = 'hidden';
        }
        echo "<div style='visibility : {$arrowLeft};' class='btn-format l-arow-pos'>
            <a href='{$refer}&page=" . intval($auctionPage - 1) . "'>Prev <i class='fas fa-angle-left'></i></a>
        </div>";
        ?>
        <ul>
            <?php

            $pageQuery = "SELECT ve_id FROM `vehicles`";
            $pageQuery = $pageQuery . '' . $where . '' . $and;
            $pageQueryResult = mysqli_query($conn, $pageQuery);
            $totalAuction = mysqli_num_rows($pageQueryResult);
            mysqli_close($conn);
            $totalAuctionPage = ceil($totalAuction / $limitAuction);
            for ($i = 1; $i <= $totalAuctionPage; $i++) {
                if ($i == $auctionPage) {
                    $activePage = 'active';
                } else {
                    $activePage = '';
                }
                echo "<li><a class='$activePage' href='{$refer}&page={$i}'>{$i}</a></li>";
            }
            ?>
        </ul>
        <?php $arrowRight = '';
        if ($auctionPage == $totalAuctionPage) {
            $arrowRight = 'hidden';
        }
        echo "<div style='visibility : {$arrowRight};' class='btn-format r-arow-pos'>
            <a href='{$refer}&page=" . intval($auctionPage + 1) . "'>Next <i class='fas fa-angle-right'></i></a>
        </div>";
        ?>
    </div>
    <!--  Pagination Section END-->

</div> <!-- auction-page END -->

<script src="./assets/js/filterrange.js"></script>
<?php include './components/footer.php' ?>
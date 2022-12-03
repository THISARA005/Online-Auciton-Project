<?php include './component/header.php' ?>

<div class="message">
    <?php include '../db/config.php';
    $limitAuction = 7;
    if (isset($_GET['page'])) {
        $auctionPage = $_GET['page'];
    } else {
        $auctionPage = 1;
    }

    $auctionOffset = ($auctionPage - 1) * $limitAuction;

    $showMsg = mysqli_query($conn, "SELECT * FROM `message`
    LEFT JOIN `users` ON `message`.`msg_from_id` = users.user_id  
    LEFT JOIN `company` ON `users`.`comp_id` = `company`.`comp_id`
    ORDER BY `msg_id` DESC LIMIT {$auctionOffset} , {$limitAuction}");
    if (mysqli_num_rows($showMsg) > 0) {
    ?>
        <table>
            <tr>
                <th>Msg Id</th>
                <th>User Id</th>
                <th>Message</th>
                <th>Company Name</th>
                <th>Requested Date</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
            <?php
            while ($msg = mysqli_fetch_assoc($showMsg)) {
                if ($msg['msg_status'] === '1') {
                    $unread = 'un_read';
                    $unread_bold = 'unread_bold';
                }
                echo "
                <tr class='{$unread_bold}'>
                <td class='{$unread}'>{$msg['msg_id']}</td>
                    <td ><a href='{$hostname}admin/schedule.php?msg={$msg['msg_id']}'>{$msg['msg_from_id']}</a></td>
                    <td>{$msg['detail']}</td>
                    <td>{$msg['comp_nam']}</td>
                    <td >{$msg['schedule_date']}</td>
                    <td >{$msg['email']}</td>
                    <td >{$msg['contact']}</td>
                </tr> 
                ";
            }
            ?>
        </table>
    
    <div class="pagination">
        <?php $arrowLeft = '';
        if ($auctionPage == 1) {
            $arrowLeft = 'hidden';
        }
        echo "<div style='visibility : {$arrowLeft};' class='btn-format l-arow-pos'>
            <a href='message.php?page=" . intval($auctionPage - 1) . "'>Prev <i class='fas fa-angle-left'></i></a>
        </div>";
        ?>
        <ul>
            <?php
            $pageQuery = "SELECT msg_id FROM `message`";
            $pageQueryResult = mysqli_query($conn, $pageQuery);
            $totalAuction = mysqli_num_rows($pageQueryResult);
            $totalAuctionPage = ceil($totalAuction / $limitAuction);
            for ($i = 1; $i <= $totalAuctionPage; $i++) {
                if ($i == $auctionPage) {
                    $activePage = 'active';
                } else {
                    $activePage = '';
                }
                echo "<li><a class='$activePage' href='message.php?page={$i}'>{$i}</a></li>";
            }
            ?>
        </ul>
        <?php $arrowRight = '';
        if ($auctionPage == $totalAuctionPage) {
            $arrowRight = 'hidden';
        }
        echo "<div style='visibility : {$arrowRight};' class='btn-format r-arow-pos'>
            <a href='message.php?page=" . intval($auctionPage + 1) . "'>Next <i class='fas fa-angle-right'></i></a>
        </div>";
        ?>
    </div>
    <?php } else{
        echo "No record found !";
    } ?>
</div>

<?php include './component/footer.php' ?>
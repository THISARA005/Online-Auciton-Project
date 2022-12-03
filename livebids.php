<?php
include './db/config.php';

// Get Data From Live Bid Page
if (isset($_POST['bid'])) {
    $bidid = $_POST['bid'];
} else {
    echo "fail";
}
if (isset($_POST['bidstrtp'])) {
    $bidstrtp = $_POST['bidstrtp'];
} else {
    echo 'fail';
}

$selectBid = "SELECT * from `bidding`
        LEFT JOIN `vehicles` ON bidding.bid_id = vehicles.ve_id
        LEFT JOIN `users` ON bidding.user_byerid = users.user_id
        WHERE bidding.ve_id = $bidid ORDER BY bid_amount DESC";

$bidResult = mysqli_query($conn, $selectBid);
if (mysqli_num_rows($bidResult) > 0) {

    mysqli_query($conn, "UPDATE `vehicles` SET `ve_status`= 1 WHERE ve_id = $bidid");
    $soldUpdateQ = mysqli_query($conn, "SELECT bid_amount, ve_id, user_byerid FROM `bidding` WHERE ve_id = $bidid ORDER BY bid_amount DESC LIMIT 1");
    $soldUpdate = mysqli_fetch_assoc($soldUpdateQ);
    $soldTableCheck = mysqli_query($conn, "SELECT * FROM sold WHERE ve_id = $soldUpdate[ve_id]");
    if (!mysqli_num_rows($soldTableCheck) > 0) {
        mysqli_query($conn, "INSERT INTO `sold`(`buyer_id`, `ve_id`, `price`) VALUES ($soldUpdate[user_byerid],$soldUpdate[ve_id],'$soldUpdate[bid_amount]')");
    } else {
        mysqli_query($conn, "UPDATE `sold` SET `buyer_id`=$soldUpdate[user_byerid],`ve_id`=$soldUpdate[ve_id],`price`='$soldUpdate[bid_amount]' WHERE ve_id = $soldUpdate[ve_id]");
    }

    $output = '';
    $output .= "<div class='live-bid-cont'>
                <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Bid Value</th>
                        <th>Bid Time</th>
                    </tr>
                    </thead>";

    while ($bid = mysqli_fetch_assoc($bidResult)) {

        $bidenterp = $bid['bid_amount'];
        if ($bidstrtp < $bidenterp) {
            $up = 'up';
            $color = 'high';
        } else {
            $up = 'down';
            $color = 'low';
        }
        $output .= "<tr>
                    <td><i class='fas fa-caret-{$up} {$color}'></i> <img src='uploaded/seprofileimg/{$bid['user_img']}'>{$bid['first_name']} {$bid['last_name']}</td>
                    <td>Rs {$bid['bid_amount']}</td>
                    <td>{$bid['bid_time']}</td>
                </tr>";
    }
    $output .= "</table>";
    $output .= "</div>";

    echo $output;
} else {
    echo "<h3 style='color : red'> No bid yet !</h3>";
}
mysqli_close($conn);
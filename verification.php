<!DOCTYPE html>
<html>

<head>
    <style>
        .wlcm {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            font-size: 3rem;
            color: green;
        }

        p {
            font-size: 1.5rem;
            color: gray;
        }
    </style>
</head>

<body>

    <?php

    include 'db/config.php';
    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $query = mysqli_query($conn, "SELECT email FROM `users` WHERE `email` = '$_GET[email]' AND `resettoken` = '$_GET[reset_token]' AND `resettokenexpire`='$date'");

        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $updateQ = mysqli_query($conn, "UPDATE `users` SET `resettoken`= NULL,`resettokenexpire`= NULL ,`status` = 1 WHERE `email` = '$_GET[email]'");
                if ($updateQ) {
                    echo "<div class='wlcm' id='welcome-popup'>
                        <h1>Congratulation <span>🎉</span></h1>
                        <p>You are success registered</p>
                    </div>
                    <script>
                        setInterval(()=>{
                            window.location.href='{$hostname}';
                            },7000);
                    </script>
                    ";
                } else {
                    echo "<script>
                    <h1>Server Down! Please try later</h1>;
                    setInterval(()=>{
                        window.location.href='{$hostname}';
                        },7000);
                </script>";
                }
            } else {
                echo "<script>
                    <h1>Invalid or Link time is Expire</h1>;
                    setInterval(()=>{
                        window.location.href='{$hostname}';
                        },7000);
                </script>";
            }
        } else {
            echo "<script>
                <h1>Server Downn! Please try later</h1>;
                setInterval(()=>{
                    window.location.href='{$hostname}';
                    },9000);
            </script>";
        }
    } else {
        echo " <script>
    window.location.href='{$hostname}';
</script>";
    } ?>
</body>

</html>
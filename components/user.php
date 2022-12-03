<div class="registeras" id="popup-register">
    <div class="choice">
        <h2>
            <span>Register as</span>
            <button type="reset" onclick="popup('popup-register')">X</button>
        </h2>
        <span class="reg-btn"><a href="buyer_signup.php">Buyer</a></span>
        <span class="reg-btn"><a href="seller_signup.php">Seller</a></span>
    </div>
</div>

<div class="login-form-cont" id="popup-login">
    <div class="popup-login">
        <form action="" method="POST">
            <h2>
                <span>User Login</span>
                <button type="reset" onclick="popup('popup-login')">X</button>
            </h2>
            <input type="text" name="email" id="login-email" placeholder="Enter your email" required>
            <input type="password" id="login-pass" name="password" placeholder="Password" required>
            <button type="submit" id="login-email-btn" class="login-btn" name="userlogin">Login</button>

        </form>
        <script>
            function popup(popup_nam) {
                get_popup = document.getElementById(popup_nam);
                if (get_popup.style.display == 'flex') {
                    get_popup.style.display = 'none';
                } else {
                    get_popup.style.display = 'flex'
                }
            }
        </script>
        <?php
        include 'db/config.php';
        $msg = '';
        if (isset($_POST['userlogin'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $pass = sha1($pass);
            $email = strtolower($email);
            $selectUser = "SELECT `user_id`, `email`, `pasword` , `user_type`, `status` FROM `users` WHERE `email` = '{$email}' AND `pasword` = '{$pass}'" or die("Query failed");
            $user = mysqli_query($conn, $selectUser);
            mysqli_close($conn);
            if (mysqli_num_rows($user) > 0) {
                $urow = mysqli_fetch_assoc($user);
                if ($urow['status'] === '1') {
                    if ($_POST['password']) {
                        $_SESSION['status'] = true;
                        // $_SESSION['user_email'] = $urow['email'];
                        // $_SESSION['user_pas'] = $urow['pasword'];
                        $user_type = $urow['user_type'];
                        if ($user_type == 'seller') {
                            $_SESSION['se_userid'] = $urow['user_id'];
                            $_SESSION['user'] = $urow['user_id'];
                            echo "
                                <script>
                                    window.location.href='{$hostname}seller/overview.php';
                                </script>
                                ";
                        } elseif ($user_type == 'buyer') {
                            $_SESSION['bu_userid'] = $urow['user_id'];
                            $_SESSION['user'] = $urow['user_id'];
                            echo "
                                <script>
                                    window.location.href='{$hostname}buyer/overview.php';
                                </script>
                                ";
                        } else {
                            echo "
                                <script>
                                    window.location.href='{$hostname}index.php';
                                </script>
                                ";
                        }
                    }
                } else {
                $msg = "<b>Verify !</b> Please verify Your email first<br>Click on buttton<b>Send Email</b>";
                $_SESSION['stat'] = 0;
                echo  "
                    <script> 
                        popup('popup-login');
                    </script>";
                }
            } else {
                $msg = "<b>Invalid !</b> Please enter correct Login details";
                echo  "
                    <script> 
                        popup('popup-login');
                    </script>";
            }
        }
        ?>
        <small id="login-error" style='font-size: .9rem; color: red; width: 100%;'><?php echo $msg ?></small>
        <div class="forget-btn">
            <button type="button" onclick="forgetPopup()"><?php If(isset($_SESSION['stat']) && $_SESSION['stat'] === 0){
                    echo 'Send Email';
                }else{
                    echo 'Forget Password ?';
                } ?></button>
        </div>
    </div>
</div>

<div class="login-form-cont" id="forget-login">
    <div class="popup-login forget">
        <form action="db/forgetpassword.php" method="POST">
            <h2>
                <span><?php If(isset($_SESSION['stat']) && $_SESSION['stat'] === 0){
                    echo 'Send Verification Email';
                }else{
                    echo 'Reset Password';
                } ?></span>
                <button type="reset" onclick="popup('forget-login')">X</button>
            </h2>
            <?php If(isset($_SESSION['stat']) && $_SESSION['stat'] === 0){
                    echo '<input type="text" name="email_stat" placeholder="Enter your email">';
                    unset($_SESSION['stat']);
                }else{
                    echo '<input type="text" name="email" placeholder="Enter your email">';
                } ?>
            <button type="submit" class="login-btn" name="send_reset_link">Send</button>
        </form>
        <div class="forget-btn">
            <button type="button" onclick="loginPopup()">Back To Signin</button>
        </div>
    </div>
</div>
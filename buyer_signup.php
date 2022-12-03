
<?php 
include './components/header.php';
include "db/config.php";
if (isset($_SESSION['bu_userid']) || isset($_SESSION['se_userid']) || isset($_SESSION['ad_userid'])) {
    echo "<script>
                window.location.href='{$hostname}';
            </script>";
} 
?>
<div class="sre-form-cont">
    <form action="db/buyerregister.php" method="POST" enctype="multipart/form-data">
        <h3>Create Buyer Account</h3>

        <div class="name sre-2">
            <div class="">
                <label>First Name</label>
                <div class="input in1">
                    <input type="text" id="fname" name="sefname" placeholder="John" required>
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="">
                <label>Last Name</label>
                <div class="input in2">
                    <input type="text" id="lname" name="selname" placeholder="Doe" required>
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="field-error">
            <li id="fname-error"></li>
            <li id="lname-error"></li>
        </div>
        <div class="email sre-1">
            <label>Email</label>
            <div class="input">
                <input type="email" name="seemail" id="email" placeholder="johndoe@gmail.com" required autocomplete="off">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
        <div class="field-error">
            <li id="email-error"></li>
        </div>
        <div class="password sre-2">
            <div class="">
                <label>Password</label>
                <div class="input in1">
                    <input type="password" name="sepass" id="paswrd" placeholder="*************" required autocomplete="off">
                    <i class="fas fa-eye-slash" onclick="hideorshow('paswrd')" id="togglepaswrd"></i>
                </div>
            </div>
            <div class="">
                <label>Confirm Password</label>
                <div class="input in2">
                    <input type="password" name="secpass" id="cpaswrd" placeholder="**************" required autocomplete="off">
                    <i class="fas fa-eye-slash" onclick="hideorshow('cpaswrd')" id="togglecpaswrd"></i>
                </div>
            </div>
        </div>
        <div class="field-error">
            <li id="pass-error"></li>
            <li id="cpass-error"></li>
        </div>
        <div class="comp-name sre-1">
            <label>NIC Number</label>
            <input type="text" name="nicno" id="nicno" placeholder="123456789V" required>
        </div>
        <div class="field-error">
            <li id="nicno-error"></li>
        </div>
        <div class="comp-re-nmbr sre-1">
            <label>Address</label>
            <input type="text" name="address" id="" placeholder="House # Abc Street 12B" required>
        </div>
        <div class="comp-nmbr sre-1">
            <label>Contact Number</label>
            <input type="tel" name="secontact" id="phone" placeholder="+94-11-123-4567" required>
        </div>
        <div class="field-error">
            <li id="phone-error"></li>
            <li id="phone-error1"></li>
        </div>
        <div class="sre-1">
            <label>Profile Image</label>
            <input type="file" id="pimg" name="seprofile[]" required>
        </div>
        <div class="field-error">
            <li id="pimg-error"></li>
        </div>
        <div class="agreement">
            <input type="checkbox" name="seagremnt" value="1" required>
            <p>I have read and agreed to the <a href="">terms</a> and <a href="">conditions</a></p>
        </div>
        <div class="re-signin">
            Already a member?
            <a href="javascript: void(0)" id="showPopUpLogin" onclick="popup('popup-login')">Sign In</a>
        </div>
        <div class="submit">
            <button type="submit" name="verification_link" id="regist-btn">Sign Up</button>
        </div>
    </form>
</div>

<?php 
include './components/validation.php';
include './components/footer.php';
?>
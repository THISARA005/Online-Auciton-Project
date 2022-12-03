<div class="footer" id="footer">
    <!-- Brand & Contact Section  -->
    <div class="contct">
        <div class="brand">
            <span><i class="fas fa-car px-2"></i></span>
            <h3>auction <span>clean car templete</span></h3>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, et numquam. Incidunt, debitis.</p>
        <div class="con-list">
            <div class="contact location">
                <div class="sqar">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <span>Canal Road 436-B</span>
            </div>
            <div class="contact phone">
                <div class="sqar">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <span>+52 417 12321</span>
            </div>
            <div class="contact email">
                <div class="sqar">
                    <i class="fas fa-envelope"></i>
                </div>
                <span>contact@gmail.com</span>
            </div>
        </div>
    </div>
    <!-- Brand & Contact Section End-->

    <!-- Feature Section -->
    <div class="fe-links">
        <h3>Feature Links</h3>
        <div class="links">
            <ul>
                <li class=""><a href="">About Us</a></li>
                <li class=""><a href="">Term & Services</a></li>
                <li class=""><a href="">Meet the Team</a></li>
                <li class=""><a href="">Privacy Policy</a></li>
                <li class=""><a href="">Company News</a></li>
            </ul>
            <ul>
                <li class=""><a href="">Shop</a></li>
                <li class=""><a href="">New Vehicles</a></li>
                <li class=""><a href="">Features</a></li>
                <li class=""><a href="">Promotions</a></li>
                <li class=""><a href="">Contact</a></li>
            </ul>
        </div>
    </div>
    <!-- Feature Section End-->

    <!-- News Section -->
    <div class="news">
        <h3>Latest News</h3>
        <?php
        include 'db/config.php';
        $date = date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $newsQ = mysqli_query($conn, "SELECT * FROM news WHERE news_date >= '$date'");
        if (mysqli_num_rows($newsQ) > 0) {
            echo "<div class='news-letter'>";
            while ($news = mysqli_fetch_assoc($newsQ)) {
                echo "<div class='news-1'>
                <img src={$NEWS_IMAGE_PATH}{$news['news_img']}>
                <div>
                    <span>{$news['news_nam']}</span>
                    <span>{$news['news_date']} | 2 comments</span>
                </div>
            </div>";
            }
            echo "</div>";
        } else {
            echo "No News Yet";
        } ?>
    </div>
    <!-- News Section End-->

    <!-- Gallary Section -->
    <div class="galry">
        <h3>Gallary</h3>
        <?php
        $galimagesQ = mysqli_query($conn, "SELECT gal_images FROM gallary LIMIT 1");
        $galimage = mysqli_fetch_assoc($galimagesQ);
        $galimages = $galimage['gal_images'];
        $galImageExplode = explode(',', $galimages);
        ?>
        <div class="gallary">
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[0] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[1] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[2] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[3] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[4] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[5] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[6] ?>" alt="">
            </div>
            <div class="gal">
                <img class="" src="<?php echo $GALLARY_IMAGE_PATH.$galImageExplode[7] ?>" alt="">
            </div>
        </div>
    </div>
    <!-- Gallary Section End-->

</div><!-- Footer End -->
</body>

</html>
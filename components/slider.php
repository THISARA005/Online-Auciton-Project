    <!-- Slideshow container -->
    <?php $imagesQ = mysqli_query($conn, "SELECT album_img FROM `slider` WHERE `album_nam` = 'album1'");
    $images = mysqli_fetch_assoc($imagesQ);
    $image = $images['album_img'];
    $image = explode(',', $image);
    mysqli_close($conn);
    ?>

    <div class="slider-con">
      <img src="<?php echo $SLIDER_IMAGE_PATH.$image[0] ?>" class="img-slide" alt="">
      <img src="<?php echo $SLIDER_IMAGE_PATH.$image[1] ?>" class="img-slide" alt="">
      <img src="<?php echo $SLIDER_IMAGE_PATH.$image[2] ?>" class="img-slide" alt="">
      <img src="<?php echo $SLIDER_IMAGE_PATH.$image[3] ?>" class="img-slide" alt="">
      <img src="<?php echo $SLIDER_IMAGE_PATH.$image[4] ?>" class="img-slide" alt="">
      <div class="img-btn">
        <button onclick="goPrev()"></button>
        <button onclick="goNext()"></button>
      </div>
      <div class="slider-layer"></div>
      <div class="brand-heading">
        <h2>Welcome to Eauction</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
      </div>
    </div>


    <div class="news-upcoming">
      <div class="news-heading">
        <h3>Check out the upcoming auctions <span>>>></span> </h3>
        <button><a href="auction.php">Auctions</a></button>
      </div>
    </div>
    <script>
      const slides = document.querySelectorAll(".img-slide");
      var counter = 0;
      slides.forEach(
        (slide, index) => {
          slide.style.left = `${index * 100}%`;
        }
      )

      const goPrev = () => {
        counter < 1 ? counter = 5 : counter;
        counter--;
        slideImg();

      }
      const goNext = () => {
        counter >= 4 ? counter = -1 : counter;
        counter++;
        slideImg();

      }
      const slideImg = () => {
        slides.forEach(
          (slide) => {
            slide.style.transform = `translateX(-${counter * 100}%)`;
          })
      }
      setInterval(() => {
        counter >= 4 ? counter = -1 : counter;
        counter++;
        slideImg();
      }, 6000);
    </script>
<?php

require_once("include/classes/header.php");

$preview =  new PreviewProvider($connection , $userLoggedIn);
echo $preview->createMoviesPreviewVideo(null);


$containers =  new CategoryContainers($connection , $userLoggedIn);
echo $containers->showMoviesCategories();


echo "<script src='https://unpkg.com/swiper/swiper-bundle.min.js'></script>

        <script>
            var swiper = new Swiper('.mySwiper', {
                
              slidesPerView: 5,
              slidesPerGroup: 3,
              spaceBetween: 5, 
              loopFillGroupWithBlank: true,

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
          });
        </script>
      ";

?>
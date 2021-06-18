<?php
    require_once("include/classes/header.php");

    if(!isset($_GET["id"])){
        ErrorMessage::show("No ID passed into page");
    }
    $entityId = $_GET["id"];
    $entity = new Entity($connection, $entityId);

   $preview = new PreviewProvider($connection, $userLoggedIn);
   echo $preview->createPreviewVideo($entity);
 
   $seasonProvider = new SeasonProvider($connection, $userLoggedIn);
   
    echo $seasonProvider->create($entity);
   
    echo " 
    <script src='https://unpkg.com/swiper/swiper-bundle.min.js'></script>

   <script>
      var swiper = new Swiper('.mySwiper', {
           
          slidesPerView: 5,
          slidesPerGroup: 3,
          spaceBetween: 4, 
          loopFillGroupWithBlank: true,

          navigation: {
               nextEl: '.swiper-button-next',
               prevEl: '.swiper-button-prev',
         },
      });
    </script>";

    $categoryContainers = new CategoryContainers($connection, $userLoggedIn);
    echo $categoryContainers->showCategory($entity->getCategoryId(), "You might also like");
?> 
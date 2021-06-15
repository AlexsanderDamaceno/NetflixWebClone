<?php
 require_once("include/classes/config.php"); 
 require_once('include/classes/Entity.php');
 require_once('include/classes/CategoryContainers.php');
 require_once("include/classes/PreviewProvider.php");
 require_once("include/classes/EntityProvider.php");
 require_once("include/classes/ErrorMessage.php");
 require_once("include/classes/SeasonProvider.php");
 require_once("include/classes/Season.php");
 require_once("include/classes/Video.php");  

      if(!isset($_SESSION["useremail"])){
            header("Location: login.php");
      }
      $userLoggedIn = $_SESSION["username"];
      
?>
<!DOCTYPE html>
<html>
<script src="assets/js/jquery-3.3.1.min.js"></script>

    <head>
     
        <title>Welcome to  Netflix</title>
        <link rel="icon" href="https://icon2.cleanpng.com/20191018/tfo/transparent-red-font-text-logo-line-download-netflix-png-icon-picture-for-free-6389315daf18171a43a4.5130568615717560551076.jpg"/>
        <link rel="stylesheet" href="assets/style/style.css">
      
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/7cef213c37.js" crossorigin="anonymous"></script>
        <script src="assets/js/script.js"></script>
      
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    </head>
    <body>
    

 
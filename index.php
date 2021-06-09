<?php
 require_once("include/classes/config.php"); 

 if(!isset($_SESSION["useremail"])){
       header("Location: login.php");
 }
?>
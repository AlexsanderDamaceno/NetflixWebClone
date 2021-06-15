<?php
    ob_start();
    session_start();

    date_default_timezone_set("America/Sao_Paulo");

    try {   
      $connection = new PDO("mysql:dbname=netflixclone2;host=localhost", "root", "");
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    } catch(PDOException $e){
      exit("Connection failed: ". $e->getMessage());
    }
?>
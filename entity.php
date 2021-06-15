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
?> 
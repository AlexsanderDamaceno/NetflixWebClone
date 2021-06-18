<?php

require_once("include/classes/header.php");

$preview =  new PreviewProvider($connection , $userLoggedIn);
echo $preview->createTVShowPreviewVideo(null);


$containers =  new CategoryContainers($connection , $userLoggedIn);
echo $containers->showTVCategories();


?>
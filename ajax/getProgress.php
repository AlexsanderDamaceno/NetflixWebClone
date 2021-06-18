<?php
    require_once("../include/classes/config.php");
    
    if(isset($_POST["videoId"]) && isset($_POST["username"])) {
        $query = $connection->prepare("UPDATE videoProgress SET finished=1, progress=0
                                        WHERE username=:username AND videoId=:videoId");
        
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();

    } else {
        echo "No videoId or username passed into file";
    }
?>
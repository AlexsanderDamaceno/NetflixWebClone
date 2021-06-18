<?php
    require_once("../include/classes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"])) {
        $query = $connection->prepare("SELECT * FROM videoProgress
                                        WHERE username=:username AND videoId=:videoId");
        
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();

        if($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO videoProgress (username, videoId)
                                            VALUES(:username, :videoId)");

            $query->bindValue(":username", $_POST["username"]);
            $query->bindValue(":videoId", $_POST["videoId"]);

            $query->execute();
        }

    } else {
        echo "No videoId or username passed into file";
    }
?>
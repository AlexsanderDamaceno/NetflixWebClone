<?php 

class PreviewProvider {
   
    private $connection, $username;

    public function  __construct($con, $username){
     
        $this->connection = $con;
        $this->username = $username;
    }

    public function createTVShowPreviewVideo(){
        $entitiesArray = EntityProvider::getTVShowEntities($this->connection , null , 1);
        
        if(sizeof($entitiesArray) == 0){
            ErrorMessage::show("No tv show to display");
        }
        return $this->createPreviewVideo($entitiesArray[0]);
    }


    public function createMoviesPreviewVideo(){
        $entitiesArray = EntityProvider::getMoviesEntities($this->connection , null , 1);
        
        if(sizeof($entitiesArray) == 0){
            ErrorMessage::show("No tv show to display");
        }
        return $this->createPreviewVideo($entitiesArray[0]);
    }

    public function  createPreviewVideo($entity){
        if($entity == null) {
            $entity = $this->getRandomEntity();
        }
        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

        $videoId = VideoProvider::getEntityVideoForUser($this->connection, $id, $this->username);
        $video = new Video($this->connection, $videoId);

        $inProgress = $video->isInProgress($this->username);
        $playButtonText = $inProgress ? "Continue Watching" : "Play";

        $seasonEpisode = $video->getSeasonAndEpisode();
        $subHeading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";

        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' style='display:none'>
                    
                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            $subHeading

                            <div class='buttons'>
                                <button onclick='watchVideo($videoId)'><i class='fas fa-play'></i> $playButtonText</button>
                                <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }


    public function createEntityPreviewSquare($entity) {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        //return "<img src='$thumbnail' title='$name' alt='Move'>";

        return "
            <a href ='entity.php?id=$id'>
                <div class='previewContainer small'>
                <div class='background'>
                <div class='left'></div>
                <div class='right'></div>
                 </div>
                    <img src='$thumbnail'  title='$name'>
                </div>
            </a>
            ";
    }


    private function getRandomEntity(){
     
        $query = $this->connection->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();
        
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $entity = EntityProvider::getEntities($this->connection, null, 1);
       
        return $entity[0];
    }

}

?>
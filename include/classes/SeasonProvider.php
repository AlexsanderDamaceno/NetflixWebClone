 <?php
    class SeasonProvider {
        private $connection, $username;

        public function __construct($con, $username){
            $this->connection = $con;
            $this->username = $username;
        }

        public function create($entity) {
            
            $seasons = $entity->getSeasons();
            
            if(sizeof($seasons) == 0){
                return;
            }

            $seasonsHtml = "";

            foreach($seasons as $season){
                $seasonNumber = $season->getSeasonNumber();

                $videosHtml = "";
                foreach($season->getVideos() as $video){
                    $videosHtml .=  "<div class='swiper-slide'>";
                    $videosHtml .= $this->createVideoSquare($video);
                    $videosHtml .=  "</div>";

                }

                $seasonsHtml .= "<div class='season'>
                                    <h3>Season $seasonNumber</h3>
                                  
                                    <div class='videos'>
                                    <div class='swiper-container mySwiper'>
                                    <div class='swiper-wrapper'>
                                    
                                        $videosHtml
                                        </div>
                                        <div class='swiper-button-prev'></div> 
                                        <div class='swiper-button-next'></div>

                                    </div>
                                </div>
                                </div>";
            }
            
            return $seasonsHtml;
        }
        private function createVideoSquare($video) {
            $id = $video->getId();
            $thumbnail = $video->getThumbnail();
            $title = $video->getTitle();
            $description = $video->getDescription();
            $episodeNumber = $video->getEpisodeNumber();

            return "<a href='watch.php?id=$id'>
                        <div class='episodeContainer'>
                            <div class='contents'>

                                <img src='$thumbnail'>

                                <div class='videoInfo'>
                                    <h4>$title</h4>
                                    <span>$description</span>
                                </div>

                            </div>
                        </div>
                    </a>";
        }
    }

?>
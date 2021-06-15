<?php
    class Video {
        private $connection, $sqlData, $entity;

        public function __construct($con, $input){
    
            $this->connection = $con;

            if(is_array($input)){
                $this->sqlData = $input;

            } else {
                $query = $this->connection->prepare("SELECT * FROM videos WHERE id=:id");
                                       
                $query->bindValue(":id", $input);
                $query->execute();

                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }
            $this->entity = new Entity($con, $this->sqlData["entityId"]);
        }
        public function getId() {
            return $this->sqlData["id"];
        }
        public function getTitle() {
            return $this->sqlData["title"];
        }
        public function getDescription() {
            return $this->sqlData["description"];
        }
        public function getFilePath() {
            return $this->sqlData["filePath"]; 
        }
        public function getThumbnail() {
            return $this->entity->getThumbnail();
        } 
        public function getEpisodeNumber() {
            return $this->sqlData["episode"];
        }
    }

?>
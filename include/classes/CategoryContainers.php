<?php
class CategoryContainers {

    private $connection, $username;

    public function __construct($con, $username) {
        $this->connection = $con;
        $this->username = $username;
    }

    public function showAllCategories() {
        $query = $this->connection->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "";
        $html .= "<div class='previewCategories'>";
      
        while($row = $query->fetch(PDO::FETCH_ASSOC))      
            $html .= $this->getCategoryHtml($row, null, true, true);

        return $html."</div>"."</br>";
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies) {
        $categoryId = $sqlData["id"];
        $title = $title == null ? $sqlData["name"] : $title;

        if($tvShows && $movies) {
            $entities = EntityProvider::getEntities($this->connection, $categoryId, 30);
        }
        else if($tvShows) {
            // Get tv show entities
        }
        else {
            // Get movie entities
        }
 
        if(sizeof($entities) == 0) {
            return;
        }
     
        $previewProvider = new PreviewProvider($this->con, $this->username);
     
        $entitiesHtml = "";
      
        foreach($entities as $entity) {
            $entitiesHtml .= "<div class='swiper-slide'>";
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
            $entitiesHtml .= "</div>";
        }
         
        return "

        <div class='category'>
            <a href='category.php?id=$categoryId'>
              <h3>$title</h3>
            </a>
            <div class='entities'>
                <div class='swiper-container mySwiper'>
                    <div class='swiper-wrapper'>
                        $entitiesHtml
                    </div>
                    
                    <div class='swiper-button-prev'></div> 
                    <div class='swiper-button-next'></div>


                </div>
            </div>          
        </div>
        ";                  
    }

}
?>
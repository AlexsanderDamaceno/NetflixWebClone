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


      public function showTVCategories() {
        $query = $this->connection->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "";
        $html .= "<div class='previewCategories'>
                  <h1>TV Shows</h1>";
      
        while($row = $query->fetch(PDO::FETCH_ASSOC))      
            $html .= $this->getCategoryHtml($row, null, true, false);

        return $html."</div>"."</br>";
    }

    public function showMoviesCategories() {
        $query = $this->connection->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "";
        $html .= "<div class='previewCategories'>
                  <h1>TV Shows</h1>";
      
        while($row = $query->fetch(PDO::FETCH_ASSOC))      
            $html .= $this->getCategoryHtml($row, null, false, true);

        return $html."</div>"."</br>";
    }

  



    public function showCategory($categoryId, $title = null) {
        $query = $this->connection->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindValue(":id", $categoryId);
        $query->execute();

        $html = "";
        $html .= "<div class='previewCategories noScroll'>";
      
        while($row = $query->fetch(PDO::FETCH_ASSOC))      
            $html .= $this->getCategoryHtml($row, $title, true, true);

        return $html."</div>"."</br>";
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies) {
        $categoryId = $sqlData["id"];
        $name = $title == null ? $sqlData["name"] : $title;

        if($tvShows && $movies) {
            $entities = EntityProvider::getEntities($this->connection, $categoryId, 30);
        }
        else if($tvShows) {
            $entities = EntityProvider::getTVShowEntities($this->connection , $categoryId , 30); 
        }
        else {
            $entities = EntityProvider::getMoviesEntities($this->connection , $categoryId , 30); 
        }
 
        if(sizeof($entities) == 0) {
            return;
        }
     
        $previewProvider = new PreviewProvider($this->connection, $this->username);
     
        $entitiesHtml = "";
      
        foreach($entities as $entity) {
            if(!$title) $entitiesHtml .= "<div class='swiper-slide'>";
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
            if(!$title) $entitiesHtml .= "</div>";
        }
         
        $categoryHtml = "
            <div class='category'>
                <a href='category.php?id=$categoryId'>
                    <h3>$name</h3>
                </a>
                <div class='entities'>
        ";

        if(!$title) $categoryHtml .= "
                    <div class='swiper-container mySwiper'>
                        <div class='swiper-wrapper'>
        ";

        $categoryHtml .= $entitiesHtml;

        if(!$title) $categoryHtml .= "
                        </div>
                        <div class='swiper-button-prev'></div> 
                        <div class='swiper-button-next'></div>
                        <div class='swiper-pagination'></div>
                        </div>
        ";

        return $categoryHtml."</div>"."</div>";

        /*return "

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
                    <div class='swiper-pagination'></div>

                </div>
            </div>          
        </div>

        ";*/                  
    }

}
?>
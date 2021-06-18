<?php 

class SearchResultsProvider {
   
    private $connection, $username;

    public function  __construct($con, $username){
     
        $this->connection = $con;
        $this->username = $username;
    }

    public function  getResults($inputText){
       
           $entity = EntityProvider::getSearchEntities($this->connection , $inputText);
        
           if($entity == false){
               return 'No movie  finded with this name.';
           }          
 
           $html = "<div class='previewCategories noScroll'>";

           $html.= $this->getResultHtml($entity);

           return $html . "</div>"; 
       

          
    
    }

    private function  getResultHtml($entities){
       
     
        

        if(sizeof($entities) == 0) {
            return;
        }
     
        $previewProvider = new PreviewProvider($this->connection, $this->username);
     
        foreach($entities as $entity) {
          
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
         
        }
        

        
        $categoryHtml = "
            <div class='category'>
                <a href='category.php?id=$categoryId'>
                    <h3>$name</h3>
                </a>
                <div class='entities'>
                     $entitiesHtml
                </div>
                </div>
        ";


        return    $categoryHtml ;

        


 }

}

?>
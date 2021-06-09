<?php 
class FormSanitizer {
  
    public static function sanitizeFormString($input_text){
        $input_text = strip_tags($input_text);
        $input_text = trim($input_text);
        $input_text = strtolower($input_text);
       
        return $input_text;
    }

    public static function sanitizeFormUsername($input_text){
        $input_text = strip_tags($input_text);
        $input_text = trim($input_text);       
        
        return $input_text;
    }

    public static function sanitizeFormEmail($input_text){
        $input_text = strip_tags($input_text);
        $input_text = str_replace(" ", "", $input_text); 
        $input_text = strtolower($input_text);      
        
        return $input_text;
    }

    public static function sanitizeFormPassword($input_text){
        $input_text = strip_tags($input_text); 
               
        return $input_text;
    }
}
?>
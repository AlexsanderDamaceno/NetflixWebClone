<?php 

class Account {
  private $connection; 
  private $errorArray = array();

  public function __construct($con){
    $this->$connection = $con; 
  }

  public function register($fn , $ln , $un , $em , $em2 ,  $pw , $pw2)
  {
      $this->validateFirstName($fn); 
      $this->validateLastName($ln); 
      $this->validateUsername($un);
      $this->validateEmail($em , $em2);
      $this->validatepassword($pw , $pw2);

      if(empty($this->errorArray)) {
        return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
      }
      return false;
  }

  public function Login($em, $pw) {
    $pw = hash("sha512", $pw);

    $query = $this->$connection->prepare("SELECT * FROM  users WHERE email=:em AND password =:pw");
                                       
    $query->bindValue(":em", $em);
    $query->bindValue(":pw", $pw);
    $query->execute();
 
    if($query->rowCount() == 1) {
      return true;
    }

    array_push($this->errorArray , Constants::$loginfailed);     
    return false;
  }

  private function insertUserDetails($fn, $ln, $un, $em, $pw) {
    $pw = hash("sha512", $pw);

    $query = $this->$connection->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                          VALUES (:fn, :ln, :un, :em, :pw)");
    $query->bindValue(":fn", $fn);
    $query->bindValue(":ln", $ln);
    $query->bindValue(":un", $un);
    $query->bindValue(":em", $em);
    $query->bindValue(":pw", $pw);

    return $query->execute();
  }

  private function validateFirstName($fn) {
    if(strlen($fn) < 2 || strlen($fn) > 50) {
       array_push($this->errorArray, Constants::$firstNameCharacters);
       return; 
    }    
  }

  private function validateLastName($ln) {
    if(strlen($ln) < 2 || strlen($ln) > 50) {
      array_push($this->errorArray, Constants::$lastNameCharacters);
      return;
    }
  }
  
  private function validateUsername($un) {

    if(strlen($un) < 2 || strlen($un) > 50) {
      array_push($this->errorArray,  Constants::$usernameCharacters);
      return;
    }
  
    $query = $this->$connection->prepare("SELECT * FROM users WHERE username=:un");
    $query->bindValue(":un" , $un);
    $query->execute(); 

    if($query->rowCount() != 0){
      array_push($this->errorArray, Constants::$duplicateUsername);
    }
  }
   
  private function validateEmail($em , $em2) {

    if($em != $em2) {
      array_push($this->errorArray,  Constants::$emailsDontMatch);
      return;
    }

    if (!filter_var($em , FILTER_VALIDATE_EMAIL)){
      array_push($this->errorArray,  Constants::$emailInvalid); 
      return; 
    }
    
    $query = $this->$connection->prepare("SELECT * FROM users WHERE email=:em");
    $query->bindValue(":em" , $em);
    $query->execute(); 

    if($query->rowCount() != 0){
      array_push($this->errorArray,   Constants::$emailTaken);
    }
    return;
  }
  
  private function validatepassword($pw , $pw2) {

    if($pw != $pw2) {
      array_push($this->errorArray,  Constants::$passwordsDontMatch);
      return;
    }

    if(strlen($pw) < 2 || strlen($pw) > 255) {
      array_push($this->errorArray,  Constants::$passwordInvalid);
      return;
    }
    return; 
  }

  public function getError($error) {
    if(in_array($error, $this->errorArray)) {
      return "<span class='errorMessage'>$error </span>";
    }
  }
}

?>

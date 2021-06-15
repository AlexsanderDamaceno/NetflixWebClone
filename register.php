<?php
require_once("include/classes/config.php");
require_once("include/classes/FormSanitizer.php");
require_once("include/classes/Constants.php");
require_once("include/classes/Account.php");

    $account  = new Account($connection);

    if(isset($_POST["submitButton"])) {
        
        $firstname = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastname  = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username  = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email     = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2    = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password  = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
        
        $success = $account->register($firstname , $lastname ,  $username , $email , $email2 , $password , $password2);
    
        if($sucess) {
            // store session
            header("Location: index.php");
        }
    }

function getInputValue($name) {
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html> 

<html> 

<head>
    <title> Welcome to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
    <link rel="icon" href="https://icon2.cleanpng.com/20191018/tfo/transparent-red-font-text-logo-line-download-netflix-png-icon-picture-for-free-6389315daf18171a43a4.5130568615717560551076.jpg">
</head>

<body> 

    <div class="signInContainer">
        <div class="column">

            <div class = "header">
                <img src="https://www.freepnglogos.com/uploads/netflix-logo-history-32.png" title="Logo" alt="Site logo"/>
                <h2>Sign Up</h2>
            </div>
            
            <form method = "POST">
                   
                <input type="text"     name="firstName"      placeholder="First name" value="<?php getInputValue("firstName")?>" required/>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>  
              
                <input type="text"     name="lastName"       placeholder="Last name" value="<?php getInputValue("lastName")?>" required/>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?> 
               
                <input type="text"     name="username"       placeholder="Username" value="<?php getInputValue("username")?>" required/>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$duplicateUsername); ?>
              
                <input type="email"    name="email"          placeholder="Email" value="<?php getInputValue("email")?>" required/>
                <input type="email"    name="email2"         placeholder="Confirm email" value="<?php getInputValue("email2")?>" required/>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?> 
             
                <input type="password" name="password"       placeholder="Password" required/>
                <input type="password" name="password2"      placeholder="Confirm password" required/>
                <?php echo $account->getError(Constants::$passwordInvalid); ?>
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>  

                <input type="submit"   name="submitButton"   value ="Register"/>
            </form>
            <a href="login.php"  class="sigInmessage" high>Already have an account? Sign in here!</a>
        </div>
    </div>
</body> 

</html>
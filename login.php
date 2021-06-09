<?php

    require_once("include/classes/config.php"); 
    require_once("include/classes/FormSanitizer.php");  
    require_once("include/classes/Constants.php");
    require_once("include/classes/Account.php");

    $account = new Account($connection);

    if(isset($_POST["submitButton"])) {
        $email  = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $password  = FormSanitizer::sanitizeFormPassword($_POST["password"]);
       
        $sucess = $account->login($email, $password);

        if($sucess)
        {
            $_SESSION["useremail"] = $email;
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
    <link rel="stylesheet" type="text/css" href="assets/style/logstyle.css">
    <link rel="icon" href="https://icon2.cleanpng.com/20191018/tfo/transparent-red-font-text-logo-line-download-netflix-png-icon-picture-for-free-6389315daf18171a43a4.5130568615717560551076.jpg">
</head> 

<body> 
    <div class="signInContainer">
        <div class="column">

            <div class = "header">
                <img src="https://www.freepnglogos.com/uploads/netflix-logo-history-32.png" title="Logo" alt="Site logo"/>
            </div>
            
            <form method = "POST">
                <input type="email"     name="email"         placeholder="Email" value="<?php getInputValue("email")?>" required/>
                <input type="password"  name="password"       placeholder="Password" required/>
                <input type="submit"    name="submitButton"   value ="Login"/>
                <?php echo $account->getError(Constants::$loginfailed); ?> 
            </form>

            <a href="register.php"  class="signInmessage" high> New to Netflix? Sign up now.</a>
        </div> 
    </div>
</body> 

</html>
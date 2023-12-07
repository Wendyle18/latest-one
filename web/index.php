<?php
require ("_config.php");
require (DATA."pages.php");
require (DATA."users.php");
require (DATA."roles.php");
require (DATA."role_privileges.php");


$labelindicator = "";
if( $_POST){
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $usernames= array_column($users, "username");  
    $passwords = array_column($users, "password");  
    
    
        if(in_array($username, $usernames)){
        if(in_array($password, $passwords)){
            
            $label = "success";
            $labelindicator = "Successfully Login";
            

        }else{
           
            $label = "error";
            $labelindicator = "Incorrect Username and Password";
        }
    }else{
           
            $label = "error";
            $labelindicator = "Incorrect Username and Password";
}
}





$error = false;
$page = $pages ["dashboard"];
$urlSegments = explode ("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (array_key_exists ("3", $urlSegments)&& !empty ($urlSegments[3]) ){    
    if (array_key_exists ($urlSegments[3], $pages)){
        $page = $pages[$urlSegments [3]];
    }  
    else{ 
        $page = $pages ["404"];
        $error = true;
    } 

}

?>
<!DOCTYPE html>

<!--suppress HtmlDeprecatedAttribute -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_PATH."fontawesome/fontawesome.css" ?>">
    <link rel="stylesheet" href="<?= CSS_PATH. "fontawesome/solid.css" ?>">
    <link rel="stylesheet" href="<?= CSS_PATH ?>main.css">
    <link rel="stylesheet" href="<?= CSS_PATH. $page["stylesheet"]?>">
    <link rel="icon" type="image" href="<?= IMG_PATH ?>2.png">
    <title><?= $page["title"] ?></title>
</head>

        <body>
            
                <?php 
                    if($error){
                        require (PAGE_PATH. DS.$page["file"]);
                    }elseif($page == $pages["login"]){
                        require (PAGE_PATH. DS.$page["file"]);
                    }
                    else{
                        require ( ELEMENTS."header.php");
                        require ( ELEMENTS."sidebar.php");
                        require ( PAGE_PATH .$page["file"]);
                        require ( ELEMENTS."footer.php");
                    }
                           
                     
                            
                        
                ?>
        </body>
        
</html>


<?php 

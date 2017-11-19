<?php
//for the cookies - via php
//adding
/*
if(isset($_POST["theme"])){
        $expiryTime = time()+60*60*24;
        setcookie("theme", $_POST["theme"],$expiryTime);
    }
*/
//removing
/*
if(isset($_COOKIE["philosopher"])){
        unset($_COOKIE["philosopher"]);
        setcookie("philosopher", "", time()-60*60*24);
    }
*/
//for the cookies - via javascriot
/*
    document.cookie = "username=John Doe; expires=Thu, 18 Dec 2017 12:00:00 UTC"; //to create
    var x = document.cookie; //to read
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"; //to delete, set time in past
*/

include 'includes/book-config.inc.php';

// code to check session can be put in the functions include file

// if isset($_COOKIE['']) {
// else { 
    $userLogDb=new UsersLoginGateway($connection);
    
    $userCheck=$userLogDb->getByKey($_POST['username']);
    $test = $userCheck['Salt'];
    
    if (empty($userCheck)) {
    echo "Incorrect Username. Please try again.";
    } else {
        $passCheck=$userLogDb->matchData(md5($_POST['password'] . $userCheck['Salt']));
        if (empty($passCheck)) {
            echo "Incorrect Password. Please try again";
        } else {
            //if statement: redirect to index or previous page
            header("Location:index.php");
        }
    }
//}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>

<body>
    <div class="mdl-layout mdl-js-layout">
            
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">


                <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp centered" >
                <div class="mdl-card__title mdl-color--blue-grey mdl-color-text--white">
                    <div class="mdl-layout-spacer"></div>
                    <h2 class="mdl-card__title-text ">Welcome!</h2>
                    <div class="mdl-layout-spacer"></div>
                </div>
                <div class="mdl-grid mdl-cell--8-col">
                    <form action="login.php" method="post">
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="text" id="username" name="username"/>
                            <label class="mdl-textfield__label" for="username">Username</label>
                        </div>
        
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                            <label class="mdl-textfield__label" for="password">Password</label>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Login</button>
                    </form>
                </div>
                

              </div>  <!-- / mdl-cell + mdl-card -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
<?php

include 'includes/book-config.inc.php';
include 'includes/functions.inc.php';

session_start();

$badUser=false;$badPass=false;

$check = checkSession();

/* if a session state variables exists, redirect to index.php
if neither username nor password are posted, continue with code
otherwise, attempt login */
if ($check) {
    header("Location:index.php");
} else if (!isset($_POST['username']) || !isset($_POST['password'])) {
    //continue
} else {
    $userLogDb=new UsersLoginGateway($connection);
    
    $userCheck=$userLogDb->getByKey($_POST['username']);
    
    //check if username exists
    if (empty($userCheck)) {
    $badUser=true;
    } else {
        //check if password matches username
        $passCheck=$userLogDb->matchData(md5($_POST['password'] . $userCheck['Salt']));
        if (empty($passCheck)) {
            $badPass=true;
        } else {
            //if username and password are good, save session state variables
            $userDb=new UsersGateway($connection);
            
            $userCred=$userDb->matchData2($userCheck['UserID'], null, "1");
            
            foreach ($userCred as $row) {
                $expiryTime = time()+60*60;

                $_SESSION["User"] = $row["UserID"];
                $_SESSION["FirstName"] = $row["FirstName"]; 
                $_SESSION["LastName"] = $row["LastName"]; 
                $_SESSION["Email"] = $row["Email"]; 
            }
            
            // redirects to the previous page if user was redirected
            // otherwise redirects to index.php
            if (isset($_GET['prevurl'])) {
                header("Location:" . $_GET['prevurl']);
            } else {
                header("Location:index.php");
            }
            
        }
    }
}
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
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                    <div class="mdl-layout-spacer"></div>
                    <h2 class="mdl-card__title-text ">Welcome!</h2>
                    <div class="mdl-layout-spacer"></div>
                </div>
                <div class="mdl-grid mdl-cell--8-col">
                <?php
                if (!isset($_GET['prevurl'])) {
                    echo '<form action="login.php" method="post" id="mainForm">';
                } else {
                    echo '<form action="login.php?prevurl=' . $_GET['prevurl'] . '" method="post" id="mainForm">';
                }
                ?>
                        <!--focus event: hide the error message -->
                        
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="text" id="username" name="username"/>
                            <label class="mdl-textfield__label" for="username">Username</label>
                        </div>
                        <?php
                        if ($badUser) {
                            echo '<div id="error" style="color: red">Incorrect Username</div>';
                        }
                        ?>

                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                            <label class="mdl-textfield__label" for="password">Password</label>
                        </div>
                        <?php
                        if ($badPass) {
                            echo '<div id="error" style="color: red">Incorrect Password</div>';
                        }
                        ?>
                        <br>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--blue-700 mdl-color-text--white">Login</button>
                        <a href="register.php"><p>New user? Register here!</p></a>
                    </form>
                </div>

              </div>  <!-- / mdl-cell + mdl-card -->

        </section>
    </main>

</div>    <!-- / mdl-layout --> 
    
</body>
<script>
     $("form input").on("input", function() {
       $("#error").remove();
    });
</script>
<!-- Nothing to see here!-->
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
</html>
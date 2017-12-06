<?php
include 'includes/book-config.inc.php';
include 'includes/functions.inc.php';
$salt = md5(microtime());
session_start();
$check = checkSession();


if($check){
     header("Location:index.php");
}else if(isset($_POST["LastName"]) && isset($_POST["City"]) && isset($_POST["Country"]) && isset($_POST["Email"]) && isset($_POST["Password"])){
    //manditory : LastName Email City Country Password
    //not manditory: FirstName PhoneNumber Address Region Postal
    $pass = md5($_POST["Password"] . $salt);
    $Date = date(("D M d, Y, g:i a"));
    
}



$userNames=new RegisterUserNameCheckGateway($connection);
$allUserNames = $userNames->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
    <script type="text/javascript" src="js/registerErrors.js"></script>
</head>

<body>
    <div class="mdl-layout mdl-js-layout">
            
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">


                <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp centered" >
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                    <div class="mdl-layout-spacer"></div>
                    <h2 class="mdl-card__title-text ">Please enter your information below</h2>
                    <div class="mdl-layout-spacer"></div>
                </div>
                <div class="mdl-grid mdl-cell--8-col">
                <form action="register.php" method="post" id="registerForm">

                        
                        <!-- class="required hilightable" also needs js for valid pattern-->
                        <div class="mdl-textfield mdl-js-textfield required hilightable">
                            <input class="mdl-textfield__input required hilightable" type="text" id="Email" name="Email"/>
                            <label class="mdl-textfield__label required hilightable" for="Email">Email</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield hilightable">
                            <input class="mdl-textfield__input hilightable" type="text" id="FirstName" name="FirstName"/>
                            <label class="mdl-textfield__label hilightable" for="FirstName">First Name</label>
                        </div>
                        
                        <!-- class="required hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield required hilightable">
                            <input class="mdl-textfield__input required hilightable" type="text" id="LastName" name="LastName"/>
                            <label class="mdl-textfield__label required hilightable" for="LastName">Last Name</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield hilightable">
                            <input class="mdl-textfield__input hilightable" type="text" id="PhoneNumber" name="Phone Number"/>
                            <label class="mdl-textfield__label hilightable" for="PhoneNumber">Phone number +1 (123) 123-1234</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield hilightable">
                            <input class="mdl-textfield__input hilightable" type="text" id="Address" name="Address"/>
                            <label class="mdl-textfield__label hilightable" for="Address">Address</label>
                        </div>
                        
                        <!-- class="required hilightable" -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label required hilightable">
                            <select class="mdl-selectfield__select required hilightable" id="Country" name="Country">
                              <option value=""></option>
                              <?php //needs better formatting
                              /*
                                  <option value="option1">option 1</option>
                              */
                              ?>
                            </select>
                            <label class="mdl-selectfield__label" for="Country">Country</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hilightable">
                            <select class="mdl-selectfield__select hilightable" id="Region" name="Region">
                              <option value=""></option>
                              <?php 
                              //use js possibly to update this field based on country above, and the state it's linked to for region
                              /*
                                  <option value="option1">option 1</option>
                              */
                              ?>
                            </select>
                            <label class="mdl-selectfield__label hilightable" for="Region">Region</label>
                        </div>
                        <!-- May need to change to a select if we have a way of getting all cities in a region-->
                        <!-- class="required hilightable"-->
                        <div class="mdl-textfield mdl-js-textfield required hilightable">
                            <input class="mdl-textfield__input required hilightable" type="text" id="City" name="City"/>
                            <label class="mdl-textfield__label required hilightable" for="City">City</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield hilightable">
                            <input class="mdl-textfield__input hilightable" type="text" id="Postal" name="Postal"/>
                            <label class="mdl-textfield__label hilightable" for="Postal">Postal Code</label>
                        </div>
                        
                        <!-- class="required hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield required hilightable">
                            <input class="mdl-textfield__input required hilightable" type="Password" id="Password" name="Password"/>
                            <label class="mdl-textfield__label required hilightable" for="Password">Password</label>
                        </div>
                        
                        <!-- class="required hilightable" probably should also check if passwords match-->
                        <div class="mdl-textfield mdl-js-textfield required hilightable">
                            <input class="mdl-textfield__input required hilightable" type="Password" id="Password2" name="Password2"/>
                            <label class="mdl-textfield__label required hilightable" for="Password2">Re-Enter Password</label>
                        </div>
                        
                        <br>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--blue-700 mdl-color-text--white">Register</button>
                    </form>
                </div>

              </div>  <!-- / mdl-cell + mdl-card -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
    
</body>

<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>

</html>
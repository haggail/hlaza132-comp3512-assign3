<?php
include 'includes/book-config.inc.php';
include 'includes/functions.inc.php';
$salt = md5(microtime());
session_start();
$check = checkSession();

$registering=new RegisterUserNameCheckGateway($connection);

//format in the same way login.php is

if($check){
     header("Location:index.php");
}else if(isset($_POST["Email"])){
    //testing if username is the same as 1 in database
    $allUserNames = $registering->getAll();
    
    foreach($allUserNames as $checker){
            if($checker == $_POST["Email"]){
            $_POST['exist'] = true;
            header("Location:register.php");
            break;
        }
    }
}


if(!$_POST['exist'] && isset($_POST["LastName"]) && isset($_POST["City"]) && isset($_POST["Country"]) && isset($_POST["Email"]) && isset($_POST["Password"])){
    //manditory : LastName Email City Country Password
    //not manditory: FirstName PhoneNumber Address Region Postal
    
    //creating security
    $pass = md5($_POST["Password"] . $salt);
    $Date = date(("D M d, Y, g:i a"));
    
    //adding everything to database
    $param = $registering->registerUser($_POST["LastName"], $_POST["City"], $_POST["Country"], $_POST["Email"], $pass, $salt, $Date, $_POST["FirstName"], $_POST["PhoneNumber"], $_POST["Address"], $_POST["Region"], $_POST["Postal"]);
}




$countries = new CountryGateway($connection);
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
    
    <script src="js/registerErrors.js"></script>

</head>

<body>
    <div class="mdl-layout mdl-js-layout">
            
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">


                <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--8-col card-lesson mdl-card  mdl-shadow--2dp centered" >
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                    <div class="mdl-layout-spacer"></div>
                    <h2 class="mdl-card__title-text ">Please enter your information below</h2>
                    <div class="mdl-layout-spacer"></div>
                </div>
                <div class="mdl-grid mdl-cell--8-col">
                <form action="register.php" method="post" id="registerForm">

                        
                        <!-- class="required hilightable" also needs js for valid pattern-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable" type="text" id="Email" name="Email"/>
                            <?php 
                                if($_POST['exist']){
                                    echo "<label class='mdl-textfield__label' for='Email'>Email*</label>";
                                    echo '<div id="error" style="color: red">Incorrect Password</div>';
                                }else{
                                    echo "<label class='mdl-textfield__label' for='Email'>Email*</label>";
                                }
                                
                            ?>
                            
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input hilightable" type="text" id="FirstName" name="FirstName"/>
                            <label class="mdl-textfield__label " for="FirstName">First Name</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input hilightable" type="text" id="PhoneNumber" name="PhoneNumber"/>
                            <label class="mdl-textfield__label" for="PhoneNumber">Phone number</label>
                        </div>
                        
                        <!-- class="required hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable" type="text" id="LastName" name="LastName"/>
                            <label class="mdl-textfield__label" for="LastName">Last Name* </label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input hilightable" type="text" id="Address" name="Address"/>
                            <label class="mdl-textfield__label" for="Address">Address</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hilightable">
                            <label class="mdl-selectfield__label hilightable" for="Region">Region</label><br>
                            <select class="mdl-selectfield__select hilightable" id="Region" name="Region">
                              <option value="">Select a Region</option>
                              <?php 
                                $popRegions = $countries->getAll("Continent", "Continent", null);
                                
                                foreach ($popRegions as $row) {
                                    echo '<option value=' . $row['Continent'] . '>' . $row['Continent'] . '</option>';
                                }
                              ?>
                            </select>
                        </div>
                        <br>
                        <!-- class="required hilightable" -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <label class="mdl-selectfield__label" for="Country">Country</label><br>
                            <select class="mdl-selectfield__select required hilightable" id="Country" name="Country">
                              <option value="">Select a Country</option>
                              <?php //needs better formatting
                                $popCountries = $countries->getAll(null, "CountryName", null);
                                
                                foreach($popCountries as $row){
                                    echo '<option value=' . $row['CountryCode'] . '>' . $row['CountryName'] . '</option>'; 
                                }
                              ?>
                            </select>
                        </div>
                        
                        <!-- May need to change to a select if we have a way of getting all cities in a region-->
                        <!-- class="required hilightable"-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable" type="text" id="City" name="City"/>
                            <label class="mdl-textfield__label" for="City">City</label>
                        </div>
                        
                        <!-- class="hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input hilightable" type="text" id="Postal" name="Postal"/>
                            <label class="mdl-textfield__label" for="Postal">Postal Code</label>                          
                        </div>
                        
                        <!-- class="required hilightable" -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable pass" type="Password" id="Password" name="Password"/>
                            <label class="mdl-textfield__label" for="Password">Password*</label>
                        </div>
                        
                            
                        <!-- class="required hilightable" probably should also check if passwords match-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable pass" type="Password" id="Password2" name="Password2"/>
                            <label class="mdl-textfield__label" for="Password2">Re-Enter Password*</label>
                        </div>
                        
                        <div id="passMatch" style="color: red"></div>
                        

                        
                        
                        <script>
                        
                        </script>
                        
                        
                        <br>
                        <div class="buttons">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--blue-700 mdl-color-text--white">Register</button>
                            <span>&emsp;&emsp; *Required Fields</span>
                            <!-- <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--blue-700 mdl-color-text--white">Clear Data</button> -->
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $("form").submit(function(e){
                                if ($("#Password").val() != $("#Password2").val()){
                                e.preventDefault();
                                }else{}
                            });
                            
                            $(".pass").on("input", function() {
                                if ($("#Password").val() == $("#Password2").val()) {
                                    $("#passMatch").html("");
                                } else {
                                    $("#passMatch").html("Passwords do not match");
                                }
                            });
                        });
                    </script>
                </div>

              </div>  <!-- / mdl-cell + mdl-card -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
    <!-- <script>
    /* $(document).ready(function(){
            $("highlightable").focus(function(){$(this).css("border-color", "#99b3ff");});
            $("highlightable").blur(function(){$(this).css("border-color", "#ffffff");});
    });*/
    
    /*$(document).submit(function(){
        $("required").focus(function(){$("required").css("border-color", "#FF1744");});
        $("required").blur(function(){$("required").css("border-color", "#ffffff");});
    })*/
</script> -->
    
    
</body>

<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>

</html>
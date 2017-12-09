<?php
include 'includes/book-config.inc.php';
include 'includes/functions.inc.php';
//creates a salt every time the page is loaded for slightly more security. salt will change every time there's an error in creating an account
//similarily it won't be exactly the same as the date created.
$salt = md5(microtime());

$badUser=false;
$badUser2=false;

session_start();
$check = checkSession();

//if session variables are set, redirect to index.php
if($check){
     header("Location:index.php");
}else if(!isset($_POST["LastName"]) || !isset($_POST["City"]) || !isset($_POST["Country"]) || !isset($_POST["Email"]) || !isset($_POST["Password"])){
    //continue if any of the mandatory parameters not set

}else {
    //checks if the user already exists
    $userLogDb=new UsersLoginGateway($connection);
    $userCheck=$userLogDb->getByKey($_POST['Email']);
    if(!empty($userCheck)){
            $badUser=true;
    } else if (!preg_match("/\w+@\w+\.\w+/i", $_POST['Email'])) { //checks for valid email format
            $badUser2=true;
    } else {
        //creating security and date variable
        $pass = md5($_POST["Password"] . $salt);
        $Date = date("Y-m-d H-i-s");
        
        //adding everything to database
        $registering=new RegisterUserNameCheckGateway($connection);
        $check = $registering->registerUser($_POST["LastName"], $_POST["City"], $_POST["Country"], $_POST["Email"], $pass, $salt, $Date, $_POST["FirstName"], $_POST["PhoneNumber"], $_POST["Address"], $_POST["Region"], $_POST["Postal"]);

            //if everythin updates, save session variables, login, and redirect to index
            $userLogDb=new UsersLoginGateway($connection);
            $userCheck=$userLogDb->getByKey($_POST['Email']);
            if($check) {    
                $userDb=new UsersGateway($connection);
                $userCred=$userDb->matchData2($userCheck['UserID'], null, "1");
            foreach ($userCred as $row) {
                $_SESSION["User"] = $row["UserID"];
                $_SESSION["FirstName"] = $row["FirstName"]; 
                $_SESSION["LastName"] = $row["LastName"]; 
                $_SESSION["Email"] = $row["Email"]; 
            }
   
            //redirect after logging in and setting session variables
            header("Location:index.php");
        }
    }
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
    
    <!-- The script for highlighting fields, comes from javascript lab -->
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

                        
                        <!-- email text field-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable" type="text" id="Email" name="Email"/>
                            <label class='mdl-textfield__label' for='Email'>Email*</label>
                               <?php
                                if ($badUser) { //echos error message if email used
                                    echo '<div id="error" style="color: red">Email already in use!</div>';
                                } else if ($badUser2) { //echos error message if email format is incorrect
                                    echo '<div id="error" style="color: red">Email format incorrect!</div>';
                                }
                                ?>
                            
                        </div>
                         
                        <!-- first name text field -->
                        <br>
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                                if(isset($_POST['FirstName']) && !empty($_POST['FirstName'])){
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="FirstName" name="FirstName" value="' . $_POST['FirstName'] . '"/>';
                                } else {
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="FirstName" name="FirstName"/>';
                                    echo '<label class="mdl-textfield__label" for="FirstName">First Name</label>';
                                }
                            ?>
                        </div>
                        
                        <!-- last name text field -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                                if(isset($_POST['LastName']) && !empty($_POST['LastName'])){
                                    echo '<input class="mdl-textfield__input required hilightable" type="text" id="LastName" name="LastName" value="' . $_POST['LastName'] . '"/>';
                                } else {
                                    echo '<input class="mdl-textfield__input required hilightable" type="text" id="LastName" name="LastName"/>';
                                    echo '<label class="mdl-textfield__label" for="LastName">Last Name*</label>';
                                }
                            ?>
                        </div>
                        
                        <!--phone number text field-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                            //if form was filled in and submitted, it'll keep the info in an incorrect email was used
                                if(isset($_POST['PhoneNumber']) && !empty($_POST['PhoneNumber'])){
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="PhoneNumber" name="PhoneNumber" value="' . $_POST['PhoneNumber'] . '"/>';
                                } else {
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="PhoneNumber" name="PhoneNumber"/>';
                                    echo '<label class="mdl-textfield__label" for="PhoneNumber">Phone number</label>';
                                }
                            ?>
                        </div>
                        
                        <!-- address text field -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                            //if form was filled in and submitted, it'll keep the info in an incorrect email was used
                                if(isset($_POST['Address']) && !empty($_POST['Address'])){
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="Address" name="Address" value="' . $_POST['Address'] . '"/>';
                                }else{
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="Address" name="Address"/>';
                                    echo '<label class="mdl-textfield__label" for="Address">Address</label>';
                                }
                            ?>
                        </div>
                        
                        <!-- region dropdown list -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label hilightable">
                            <label class="mdl-selectfield__label hilightable" for="Region">Region</label><br>
                            <select class="mdl-selectfield__select hilightable" id="Region" name="Region">
                                <option value="">Select a Region</option>

                              <?php 
                                $popRegions = $countries->getAll("Continent", "Continent", null);
                                foreach ($popRegions as $row) {
                                    echo '<option value=' . $row['Continent'] . '>' . $row['Continent'] . '</option>';
                                }
                            
                              //if form was filled in and submitted, it'll keep the info in an incorrect email was used
                              if(isset($_POST['Region'])){
                                
                                  echo '<script>';
                                  echo 'var region = "' . $_POST['Region'] . '";';
                                  echo '$("#Region option").each(function() {';
                                  echo 'if ($(this).val() == region) {';
                                  echo '$(this).attr("selected","selected");';
                                  echo '}});';
                                  echo '</script>';
                               
                              }
                              ?>
                             
                            </select>
                        </div>
                        <br>
                        
                        <!-- country dropdown list -->
                        <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <label class="mdl-selectfield__label" for="Country">Country*</label><br>
                            <select class="mdl-selectfield__select required hilightable" id="Country" name="Country">
                              <option value="">Select a Country</option>
                              <?php //populates dropbox
                                $popCountries = $countries->getAll(null, "CountryName", null);
                                
                                foreach($popCountries as $row){
                                    echo '<option value=' . $row['CountryCode'] . '>' . $row['CountryName'] . '</option>'; 
                                }
                                //echos out javascript to leave the option filled in when user hits submit
                                //in the case that there's an error with the username
                                if(isset($_POST['Country'])){
                                  echo '<script>';
                                  echo 'var country = "' . $_POST['Country'] . '";';
                                  echo '$("#Country option").each(function() {';
                                  echo 'if ($(this).val() == country) {';
                                  echo '$(this).attr("selected","selected");';
                                  echo '}});';
                                  echo '</script>';                                    
                                }
                               
                              ?>
                            </select>
                        </div>
                        
                        <!-- city text field-->
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                            //if form was filled in and submitted, it'll keep the info in an incorrect email was used
                                if(isset($_POST['City']) && !empty($_POST['City'])){
                                    echo '<input class="mdl-textfield__input required hilightable" type="text" id="City" name="City" value="' . $_POST['City'] . '"/>';
                                }else{
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="City" name="City"/>';
                                    echo '<label class="mdl-textfield__label" for="City">City*</label>';
                                }
                            ?>
                        </div>
                        
                        <!-- postal code text field -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <?php
                            //if form was filled in and submitted, it'll keep the info in an incorrect email was used
                                if(isset($_POST['Postal']) && !empty($_POST['Postal'])){
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="Postal" name="Postal" value="' . $_POST['Postal'] . '"/>';
                                }else{
                                    echo '<input class="mdl-textfield__input hilightable" type="text" id="Postal" name="Postal"/>';
                                    echo '<label class="mdl-textfield__label" for="Postal">Postal</label>';
                                }
                            ?>
                        </div>
                        
                        <!-- Password text field -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable pass" type="Password" id="Password" name="Password"/>
                            <label class="mdl-textfield__label" for="Password">Password*</label>
                        </div>
                        
                            
                        <!-- re-entered password field -->
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input required hilightable pass" type="Password" id="Password2" name="Password2"/>
                            <label class="mdl-textfield__label" for="Password2">Re-Enter Password*</label>
                        </div>
                        
                        <div id="passMatch" style="color: red"></div>
                        
                        
                        <br>
                        <div class="buttons">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--blue-700 mdl-color-text--white">Register</button>
                            <span>&emsp;&emsp; *Required Fields &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="login.php">Or Return to Login</a></span>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $("form").submit(function(e){
                                if ($("#Password").val() != $("#Password2").val()){
                                e.preventDefault(); //if the password and reentered password don't match, prevent the user from registering.
                                //works with function below
                                }
                            });
                            
                            $(".pass").on("input", function() { //checks if passwords match, if not displays error message
                                if ($("#Password").val() == $("#Password2").val()) {
                                    $("#passMatch").html("");
                                } else {
                                    $("#passMatch").html("Passwords do not match");
                                }
                            });
                            
                            //removes error message on input
                            $("#Email").on("input", function() {
                                $("#error").remove();
                            });
                        });
                        
                    </script>
                </div>

              </div>  <!-- / mdl-cell + mdl-card -->

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 

</body>

<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>

</html>
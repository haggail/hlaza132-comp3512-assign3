<?php

//header('Content-Type:application/json');

include 'includes/functions.inc.php';
session_start();
$check = checkSession();

if (!$check) {
    header("Location:login.php?prevurl=aboutus.php");
}

include 'includes/book-config.inc.php';


$countryDb = new CountryGateway($connection);
//$countries = $countryDb.getAll();

$bookVisitDb = new BookVisitsGateway($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Universities</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

    <link rel="stylesheet" href="css/styles.css">
    
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
       
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        
        <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--2-col">

              <!-- imprints card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--2-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--indigo-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Most Visited Countries</h2>
                </div>
                <div class="mdl-card__supporting-text">
                   <select id="country">
                        <option value="none">Select a Country</option>
                        <?php
                        $countries = $bookVisitDb->getAll();
                        
                        foreach ($countries as $row) {
                            echo '<option value=' . $row['Count'] . '>' . $row['CountryName'] . '</option>';
                        }
                        
                        
                        ?>
                    </select>
                    <div id="countryDetails"></div>
                </div>
              </div>  <!-- subcategory card -->

             </div>  <!-- / mdl-cell + mdl-card --> 
          </div>
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                    
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--red-A700 cardWidth thumbContain">
                      <i class="material-icons" role="presentation">person_outline</i>
                        <div class="text">Number of Visits</div>
                    </div>

           </div>
          
           <div class="mdl-cell mdl-cell--3-col">
                    
                    <div class="mdl-card mdl-cell mdl-cell-3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--green cardWidth thumbContain">
                      <i class="material-icons" role="presentation">location_on</i>
                        <div class="text">Visited by x Countries</div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--yellow cardWidth thumbContain">
                      <i class="material-icons" role="presentation">event_available</i>
                        <div class="text">Number of Employee To-Dos in June 2017</div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--blue cardWidth thumbContain">
                      <i class="material-icons" role="presentation">mail</i>
                        <div class="text">Number of Employee Messages in June 2017</div>
                    </div>

           </div>


            </div>  <!-- / mdl-grid -->    

        </section>
    </main>
    </div>
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
<script>
$(document).ready(function () {
    $("#country").on("change", function() {
        if ($("#country").val() == "none") {
            $("#countryDetails").html("");
        } else {
            $("#countryDetails").html("Selected Country: " + $("#country option:selected").text());
            $("#countryDetails").append("<br>Number of Visits: " + $("#country").val());
        }
    });
});
   
</script>
</html>
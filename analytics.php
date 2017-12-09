<?php

include 'includes/functions.inc.php';
session_start();
$check = checkSession();

if (!$check) {
    header("Location:login.php?prevurl=aboutus.php");
}

include 'includes/book-config.inc.php';


$countryDb = new CountryGateway($connection);

$bookVisitDb = new BookVisitsGateway($connection);
$bookVisitDb2 = new BookVisitsGateway2($connection);
$adoptions = new AdoptionBooksGateway($connection);

$toDo = new AnalyticsEmployeeToDoGateway($connection);
$messages = new AnalyticsEmployeeMsgsGateway($connection);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Analytics</title>
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
            
          </div>
          
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--red-A700 cardWidth thumbContain" id="visitTop">
                        <div class="mdl-card__media mdl-color--red-A700" id="visitImage"><img src="/images/ic_home_white_48dp_2x.png" class="centerImage"></div>

                        <div class="text" id="visits" style="opacity:0; text-align: center;"></div>
                    </div>

           </div>
          
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell-3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--green cardWidth thumbContain" id="countryTop">
                        <div class="mdl-card__media mdl-color--green" id="countryImage"><img src="/images/ic_room_white_48dp_2x.png" class="centerImage"></div>
                        
                        <div class="text" id="countryCount" style="opacity:0; text-align: center;"></div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--grey cardWidth thumbContain" id="toDoTop">
                        <div class="mdl-card__media mdl-color--grey" id="toDoImage"><img src="/images/ic_work_white_48dp_2x.png" class="centerImage"></div>

                        <div class="text" id="toDos" style="opacity:0; text-align: center;"></div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--blue cardWidth thumbContain" id="messageTop">
                        <div class="mdl-card__media mdl-color--blue" id="messageImage"><img src="/images/ic_message_white_48dp_2x.png" class="centerImage"></div>
                        
                        <div class="text" id="messages" style="opacity:0; text-align: center;"></div>
                    </div>

           </div>


            </div>  <!-- / mdl-grid -->

            <div class="mdl-grid">

            <div class="mdl-cell mdl-cell--9-col">
              <!-- book details card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--red-A700 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Top 10 Adopted Books</h2>
                    </div>

                    <div class="mdl-card__supporting-text overflow">

                        <table class="mdl-data-table  mdl-shadow--2dp alignLeft" style="margin: auto;">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Number of Adoptions</th>
                                </tr>
                                </thead>
                                    <tbody id="topTable">
                                    </tbody>
                        </table>
                    </div>    
                    </div>
              </div>  <!-- / mdl-cell + mdl-card --> 

            <div class="mdl-cell mdl-cell--3-col">

              <!-- imprints card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--3-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--indigo-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Most Visited Countries</h2>
                </div>
                <div class="mdl-card__supporting-text">
                   <select id="country">
                        <option value="none">Select a Country</option>
                    </select>
                    <br><br>
                    <div id="countryDetails"></div>
                </div>
              </div>  <!-- subcategory card -->

             </div>  <!-- / mdl-cell + mdl-card --> 

          </div>
        </section>
    </main>
    </div>
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
<script>
$(document).ready(function () {
     $.get("service-topCountries.php")
        .done(function(data) {
            for (var i = 0; i < data.length; i++) {
                $("#country").append('<option value=' + data[i].CountryCode + '>' + data[i].CountryName + '</option>');
            }
        })
        .fail(function() {
            $("#country").append('<option> error </option>');
    });
    
    $.get("service-totals.php")
        .done(function(data) {
            $("#visits").append("Number of Visits: " + data.Visits);
            $("#countryCount").append("Visited by " + data.CountryCount + " Countries");
            $("#toDos").append("Number of Employee To Dos: " + data.ToDoCount);
            $("#messages").append("Number of Employee Messages: " + data.MessageCount);

        })
        .fail(function() {
            $("#visits").append("Error retrieving data");
            $("#countryCount").append("Error retrieving data");
            $("#toDos").append("Error retrieving data");
            $("#messages").append("Error retrieving data");
    });
    
    $.get("service-topAdoptedBooks.php")
        .done(function(data) {
            for (var i = 0; i < data.length; i++) {
                $("#topTable").append('<tr><td><a href=single-book.php?isbn10=' + data[i].ISBN10 + '><img src="/book-images/thumb/' + data[i].ISBN10 + '.jpg"></a></td><td><a href=single-book.php?isbn10=' + data[i].ISBN10 + '>'  + data[i].Title + '</a></td><td>'  + data[i].TopAdopted + '</td></tr>');
            }
        })
        .fail(function() {
            $("#topTable").append('Error retrieving data');
    });
    
    $("#country").on("change", function() {
        if ($("#country").val() == "none") {
            $("#countryDetails").html("");
        } else {
            
        $.get("service-countryVisits.php")
        .done(function(data) {
            for (var i = 0; i < data.length; i++) {
                if ($("#country").val() == data[i].CountryCode) {
                    $("#countryDetails").html('Selected Country: ' + data[i].CountryName);
                    $("#countryDetails").append('<br>Total Number of Visits: ' + data[i].Count);
                }
            }
        })
        .fail(function() {
            $("#countryDetails").html('Error retrieving data');
        });
        
        }
    });
    
    function animateCard(card, image, text) {
        $(card).hover(function() {
            $(image).animate({opacity: '0'}, 200);
            $(text).animate({opacity: '1'}, 200);
        }, 
        function() {
            $(image).animate({opacity: '1'}, 200);
            $(text).animate({opacity: '0'}, 200);
        });
    }
    
    animateCard("#visitTop", "#visitImage", "#visits");
    animateCard("#countryTop", "#countryImage", "#countryCount");
    animateCard("#toDoTop", "#toDoImage", "#toDos");
    animateCard("#messageTop", "#messageImage", "#messages");


    
    
});
</script>
</html>
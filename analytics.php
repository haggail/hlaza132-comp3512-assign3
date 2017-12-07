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

$bookVisitDb = new BookVisitsGateway($connection);
$bookVisitDb2 = new BookVisitsGateway2($connection);
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
                        <?php
                        $visits = $bookVisitDb2->getAll();
                        $visitCount = 0;
                        foreach ($visits as $row) {
                            $june = "06";
                            $compare = substr_compare($row['DateViewed'], $june, 0, 1);
                            
                            if ($compare = 0) {
                              $visitCount++;
                              echo "blah";
                            }
                        }
                        
                        echo '<div class="text">Number of Visits: ' . $visitCount . '</div>';
                        ?>

                    </div>

           </div>
          
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell-3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--green cardWidth thumbContain">
                        <div class="text">Visited by X Countries</div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--grey cardWidth thumbContain">
                        <div class="text">Employee To-dos: June 2017</div>
                    </div>

           </div>
           <div class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-card mdl-cell mdl-cell--3-col card-lesson mdl-card mdl-shadow--d2p mdl-color--blue cardWidth thumbContain">
                        <div class="text">Employee Messages: June 2017</div>
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
                        
                        <table class="mdl-data-table  mdl-shadow--2dp alignLeft">
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th class="mdl-data-table__cell--non-numeric">Title</th>
                                    <th>Year</th>
                                    <th>Subcategory</th>
                                    <th>Imprint</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //checks filters and uses the correct sql statement
                                    if ($_GET['subid']=='') {
                                        if ($_GET['imprintid']=='') {
                                            $books = $bookDb->getAll("BookID", null, "20");
                                        } else {
                                            $books = $bookDb->matchData($_GET['imprintid'], null, "20");
                                        }
                                    } else {
                                         if ($_GET['imprintid']=='') {
                                            $books = $bookDb2->matchData($_GET['subid'], null, "20");

                                        } else {
                                            $books = $bookDb2->match2Key($_GET['subid'], $_GET['imprintid']);
                                        }
                                     }
                                     
                                    //if no books found, display message to that effect
                                    if (empty($books)) {
                                        echo 'No books found. Please try again.';
                                    } else {
                                        //display book details
                                        foreach ($books as $row) {
                                            echo '<tr>';
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '><img src="/book-images/thumb/' . $row['ISBN10'] . '.jpg"></a></th>';
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '>' . $row['Title'] . '</a></th>';
                                            echo '<td>' . $row['CopyrightYear'] . '</th>';
                                            echo '<td>' . $row['SubcategoryName'] . '</th>';
                                            echo '<td>' . $row['Imprint'] . '</th>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                              </tbody>
                            </table>
                    </div>    
                    </div>
              </div>  <!-- / mdl-cell + mdl-card --> 
          </div>
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
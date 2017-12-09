<?php
include 'includes/functions.inc.php';
session_start();
$check = checkSession();

// redirects to login if session state variables do not exist
if (!$check) {
    header("Location:login.php?prevurl=browse-universities.php");
}

if (isset($_GET['state'])) {
    if ($_GET['state'] == 'nofilter') {
        $filter = false;
    } else {
        $filter = true;
    }
} else {
    $filter = false;
}

include 'includes/book-config.inc.php';

$uniDb = new UniversityGateway($connection);

$statesDb = new StatesGateway($connection);
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
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>

    <main class="mdl-layout__content mdl-color--grey-50"> <!-- The grey-50 is what changes the background -->
        <section class="page-content">

            <div class="mdl-grid">
                <!-- state filter card-->
            <div class="mdl-cell mdl-cell--3-col">
                <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Filter by State</h2>
                </div>
                <div class="mdl-card__supporting-text">

                    <!-- drop-down list of US states -->
                    <form action="browse-universities.php" method="get">
                        <select name="state">
                            <option value="nofilter"> Remove Filter </option>
                            <?php
                              $states = $statesDb->getAll(null, "StateName");
                              foreach ($states as $row) {
                                  echo '<option value="' . $row['StateId'] . '">' . $row['StateName'] . '</option>';
                              }
                            ?>
                            
                        </select>
                        <input type="submit" value="Filter">
                    </form>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->

              <!-- university list card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Universities</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    
                    <ul class="demo-list-item mdl-list">

                         <?php
                        //check filters and use the appropriate sql statement to generate list of universities
                         if (!$filter) {
                            $universities = $uniDb->getAll(null, "Name", "20");
                            foreach ($universities as $row) {
                                echo '<li><a href=?universityid=' . $row['UniversityID'] . '>' . $row['Name'] . '</a></li>';
                            }
                         } else {
                             $universities = $uniDb->joinTwoTables($_GET['state']);
                            if (empty($universities)) {
                                echo 'Filter returned 0 results.';
                            } else {
                                foreach ($universities as $row) {
                                      echo '<li><a href=?state=' . $_GET['state'] . '&universityid=' . $row['UniversityID'] . '>' . $row['Name'] . '</a></li>';
                                }
                            }
                         }

                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              </div> <!-- mdl grid-->
              <!-- university details card -->
            <div class="mdl-cell mdl-cell--9-col">
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">University Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php
                        // displays uni details
                        // if no data found, display message
                        if (!isset($_GET['universityid'])) {
                            echo 'No university selected. Please select university.';
                        } else {
                            $uniDetails = $uniDb->getByKey($_GET['universityid']);
                                if (empty($uniDetails)) {
                                    echo 'Could not retrieve data. Please try again.';
                                } else {
                                    echo '<h3>' . $uniDetails['Name'] . '</h3>';
                                    echo $uniDetails['Address'] . '<br>';
                                    echo $uniDetails['City']. ', ' . $uniDetails['State'] . ' ' . $uniDetails['Zip'] . '<br>';
                                    echo $uniDetails['Website'] . '<br>';

                                    $lat = $uniDetails['Latitude'];
                                    $long = $uniDetails['Longitude'];
                                    
                                    echo '<br><script>
                                          $(document).ready(function() {
                                              window.addEventListener("load", function () {    
                                              var lat = ' . $lat . '; 
                                              var long = ' . $long . ';
                                              initMap(lat, long);
                                              });
                                          });
                                          </script>';
                                
                                    echo "<div id=\"map\"></div>";
                                }
                            }
                        ?>
                                             
                    </div>    
              </div>
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
<script>
    function initMap(latitude, longitude) {
        var location = {lat: latitude, lng: longitude};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: location
        });
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
      }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDidr97X5H7U_U-SOqpEyhbAmPvX4gFYIs">
</script>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
</html>
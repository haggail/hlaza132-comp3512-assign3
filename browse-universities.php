<?php
if (isset($_GET['state'])) {
    if ($_GET['state'] == 'nofilter')
    {
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
    <?php include 'includes/functions.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">
                
                <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--yellow">
                  <h2 class="mdl-card__title-text">Filter by State</h2>
                </div>
                <div class="mdl-card__supporting-text">

                    <form action="browse-universities.php" method="get">
                        <select name="state">
                            <option value="nofilter"> Remove Filter </option>
                            <?php
                            
                            
                              //$result = getDatabaseData("SELECT StateId, StateName FROM States ORDER BY StateName");
                              //while ($row=$result->fetch()) {
                                 // echo '<option value="' . $row['StateId'] . '">' . $row['StateName'] . '</option>';
                              //}
                              
                              $filter = $statesDb->getAll("StateName");
                              foreach ($filter as $row) {
                                  echo '<option value="' . $row['StateId'] . '">' . $row['StateName'] . '</option>';
                              }
                               
                            ?>
                            
                        </select>
                        <input type="submit" value="Filter">
                    </form>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Universities</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    
                    <ul class="demo-list-item mdl-list">

                         <?php  
                         /*
                         if (!$filter) {
                              $result = getDatabaseData("SELECT UniversityID, Name FROM Universities ORDER BY Name LIMIT 20");
                              while ($row=$result->fetch()) {
                                  echo '<li><a href=?universityid=' . $row['UniversityID'] . '>' . $row['Name'] . '</a></li>';
                              }
                         } else {
                             $result = getDatabaseData("SELECT UniversityID, Name FROM Universities JOIN States WHERE State = StateName AND StateId = ". $_GET['state'] . " ORDER BY Name LIMIT 20");
                              while ($row=$result->fetch()) {
                                  echo '<li><a href=?state=' . $_GET['state'] . '&universityid=' . $row['UniversityID'] . '>' . $row['Name'] . '</a></li>';
                              }
                         }
                           */
                           
                         $universities = $uniDb->getAll("Name", "20");
                         foreach ($universities as $row) {
                             echo '<li><a href=?universityid=' . $row['UniversityID'] . '>' . $row['Name'] . '</a></li>';
                         }

                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--6-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">University Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php
                       /* $result = getDatabaseData("SELECT Name, Address, City, State, Zip, Website, Longitude, Latitude FROM Universities WHERE UniversityID = " . $_GET['universityid']);

                        if (!$result) {
                            echo 'Could not retrieve data. Please try selecting a university.';
                        } else {
                             $row = $result ->fetch();
                             echo '<h3>' . $row['Name'] . '</h3>';
                             echo $row['Address'] . '<br>';
                             echo $row['City']. ', ' . $row['State'] . ' ' . $row['Zip'] . '<br>';
                             echo $row['Website'] . '<br>';
                             echo $row['Latitude'] . ', ' . $row['Longitude'];
                        }
                        */
                        
                        $uniDetails = $uniDb->getByKey($_GET['universityid']);
                        
                        echo '<h3>' . $uniDetails['Name'] . '</h3>';
                        echo $uniDetails['Address'] . '<br>';
                        echo $uniDetails['City']. ', ' . $uniDetails['State'] . ' ' . $uniDetails['Zip'] . '<br>';
                        echo $uniDetails['Website'] . '<br>';
                        echo $uniDetails['Latitude'] . ', ' . $uniDetails['Longitude'];
                        
                        ?>
                                                 
                    </div>    
  
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
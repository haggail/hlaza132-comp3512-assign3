<?php
include 'includes/functions.inc.php';
session_start();
$check = checkSession();

// redirects to login if session state variables do not exist
if (!$check) {
    header("Location:login.php?prevurl=single-book.php");
}

// check if query string exists
if (isset($_GET['isbn10'])) {
    $nobook = false;
} else {
    $nobook = true;
}

$badQuery=false;

include 'includes/book-config.inc.php';

//gateway connections
$single = new SingleBookGateway($connection);
$singleA = new SingleBookAuthorGateway($connection);
$singleB = new SingleBookUniversityGateway($connection);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Single Book</title>
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
            mdl-layout--fixed-header" id="body">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>

    
    
    <main class="mdl-layout__content mdl-color--grey-50" >
        <section class="page-content">

            <div class="mdl-grid">
            <!-- book details card -->
            <div class="mdl-cell mdl-cell--8-col">

              <div class="mdl-cell mdl-cell--8-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Book Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php
                        //display book details
                        //if book not found, display message
                        $singleBook = $single->matchAnd($_GET['isbn10']);
                        if (empty($singleBook)) {
                                echo '<br>Could not retrieve data. Please try again';
                                $badQuery=true;
                        } else {
                            foreach ($singleBook as $row) {
                                echo '<img src="/book-images/medium/' . $row['ISBN10'] . '.jpg" id="book" class="centerImage"><br><br>';
                                echo 'Title: ' . $row['Title'] . '<br><br>';
                                echo 'Description: ' . $row['Description'] . '<br><br>';
                                echo 'ISBN10: ' . $row['ISBN10'] . '<br><br>';
                                echo 'ISBN13: ' . $row['ISBN13'] . '<br><br>';
                                echo 'Copyright Year: ' .$row['CopyrightYear']. '<br><br>';
                                echo 'Subcategory: <a href="browse-books.php?subid=' . $row['SubcategoryID'] . '&imprintid=">' . $row['SubcategoryName']. '</a><br><br>';
                                echo 'Imprint: <a href="browse-books.php?subid=&imprintid=' . $row['ImprintID'] . '">' . $row['Imprint'] . '</a><br><br>';
                                echo 'Production Status: ' . $row['Status'] . '<br><br>';
                                echo 'Binding Type: ' . $row['BindingType'] . '<br><br>';
                                echo 'Trim Size: ' . $row['TrimSize'] . '<br><br>';
                                echo 'Page Count: ' . $row['PageCountsEditorialEst'] . '<br><br>';
                                
                                $image = $row['ISBN10'];
                            }
                        }
                        ?>
                    </div>    
              </div>
                 
              </div>  
            <div class="mdl-cell mdl-cell--4-col">
            <!-- authors card -->
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Authors</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">

                    <?php
                    // if bad query string, display message
                    // otherwise, try sql statement
                    // if sql is good, display authors
                    if ($badQuery) {
                        echo 'Could not retrieve data. Please try again';
                    } else {
                        $result = $singleA->joinTwoTables($_GET['isbn10']);
                        
                        if (!$result) {
                            echo 'Could not retrieve data. Please try selecting a book.';
                        } else {
                        foreach($result as $row) {
                            echo '<li>' . $row['FirstName'] . ' ' . $row['LastName'] . '</li>';
                            }
                        }
                    }
                    ?>
                    
                    </ul>
    
                    </div>
              </div> 
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Adopted by Universities</h2>
                </div>
                <div class="mdl-card__supporting-text">

                    <ul class="demo-list-item mdl-list">

                    <?php
                    // if bad query string, display message
                    // otherwise, try sql statement
                    // if sql is good, display universities who adopted the book                
                    if ($badQuery) {
                        echo 'Could not retrieve data. Please try again';
                    } else {
                        $result = $singleB->joinTwoTables($_GET['isbn10']);
                        
                        if (!$result) {
                            echo 'Could not retrieve data. Please try selecting a book.';
                        } else {
                            foreach($result as $row){
                                echo '<li><a href="browse-universities.php?universityid=' . $row['UniversityID'] . '">' . $row['Name'] . '</a></li>';
                            }
                        }
                    }
                    ?>
                    
                    </ul>
                </div>
              </div>  
              </div>
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
 
</div> <!-- / mdl-layout --> 
<!-- hidden div that contains large image-->
<div id="largeImg" class="centered">
    <?php
        echo '<img src="book-images/large/' . $image . '.jpg">'
    ?>
</div>
<script>
//click event for small book image unhides the large image and dims screen
    var image = document.querySelector("#book");
    image.addEventListener("click", function () {
        document.querySelector("#body").style.opacity="0.5";
        document.querySelector("body").style.backgroundColor="black";
        document.querySelector("#largeImg").style.zIndex="1";
        
        //hides the background audio when the book is clicked as it becomes shown by default due to the opacity
        document.getElementById("audio").style.visibility="hidden";

    });
//click event for large book image hides the large image and brightens screen
    var toggleHide=document.querySelector("#largeImg");
    toggleHide.addEventListener("click", function() {
        document.querySelector("#body").style.opacity="1";
        document.querySelector("body").style.backgroundColor="";
        document.querySelector("#largeImg").style.zIndex="0";
        
        //re-displays the background audio when the book is no longer visible
        document.getElementById("audio").style.visibility="visible";
    })

</script>
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true" id="audio"></embed>
</html>
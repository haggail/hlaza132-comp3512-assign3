<?php

include 'includes/functions.inc.php';
session_start();
$check = checkSession();

if (!$check) {
    header("Location:login.php?prevurl=aboutus.php");
}

include 'includes/book-config.inc.php';

if(rand(0, 10) == 10){
    header("location:https://www.youtube.com/watch?v=dQw4w9WgXcQ"); //because I could and it's funny --Brandon
}
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
            <div class="mdl-cell mdl-cell--3-col">

              <!-- imprints card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--3-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--indigo-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Most Visited Countries</h2>
                </div>
                <div class="mdl-card__supporting-text">
                   
                    <ul class="demo-list-item mdl-list">
                        <!--add stuff here-->
                    </ul>
                </div>
              </div>  <!-- subcategory card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--3-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Analytical Stuff</h2>
                </div>
                <div class="mdl-card__supporting-text">
    
                    <ul class="demo-list-item mdl-list">
                        <!--add stuff here-->
                    </ul>
                        
                </div>
              </div> 
              </div>
              <div class="mdl-cell mdl-cell--9-col">
              <!-- book details card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--deep-purple-900 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Top 10 Adopted Books</h2>
                    </div>

                    <div class="mdl-card__supporting-text overflow">
                        <!--add stuff here-->
                    </div>    
                    </div>
              </div>  <!-- / mdl-cell + mdl-card --> 
              
              
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>
    </div>
</body>

</html>
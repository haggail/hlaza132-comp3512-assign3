<?php
session_start();

include 'includes/functions.inc.php';

$check = checkSession();

// redirects to login if session state variables do not exist
if (!$check) {
header("Location:login.php?prevurl=index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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

    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-cell mdl-cell--4-col">
                    
                <a href="browse-universities.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/universities.png" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">Browse Universities</div>
                            </div>
                        </figure>
                    </div>
                    </a>
            
            <a href="browse-books.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/books.png" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">Browse Books</div>
                            </div>
                        </figure>
                    </div>
                    </a>
            
                
           </div>
           
            <div class="mdl-cell mdl-cell--4-col">
                
                <a href="browse-employees.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/Employees.jpg" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">Browse Employees</div>
                            </div>
                        </figure>
                    </div>
                    </a>
                
                <a href="profile.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/profile.png" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">User Profile</div>
                            </div>
                        </figure>
                    </div>
                    </a>
                
            </div>   
                <div class="mdl-cell mdl-cell--4-col">

                <a href="aboutus.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/aboutus.jpg" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">About Us</div>
                            </div>
                        </figure>
                    </div>
                    </a>

                    <a href="analytics.php">
                    <div class="mdl-card mdl-cell mdl-cell--4-col card-lesson mdl-card mdl-shadow--d2p cardWidth thumbContain">
                        <figure class="mdl-card__media">
                            <img src="/images/analytics.jpg" class="thumbnails" alt="" />
                            <div class="fadeIn">
                                <div class="text">Analytics</div>
                            </div>
                        </figure>
                    </div>
                    </a>
             

                    
                </div>
                <div class="mdl-layout-spacer"></div>
           </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
</html>
<?php
include 'includes/functions.inc.php';
session_start();
$check = checkSession();

if (!$check) {
    header("Location:login.php?prevurl=aboutus.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Us</title>
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
            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--red-A700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Disclaimer</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>This site is hypothetical and was created as an assignment for COMP 3512 at Mount Royal University taught by Randy Connolly</li>
                    </ul>
            </div>  
            </div>
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Resources</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>Course: COMP 3512</li>
                        <li>Current Date: <?php echo date("M d, Y"); ?></li>
                        <li><a href="https://github.com/haggail/hlaza132-comp3512-assign3">Github Where Assignment is Located</A></li>

                        <hr>
                        <li>Material Design Lite</li>
                        <li>Book Images</li>
                        <li>Liberal use of w3schools & stackoverflow for debugging purposes</li>
                        <li>Randy Connolly</li>
                        <hr>
                        <li>Profile image retrieved from: 
                            <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=1188604145">Click Here</a></li>

                        <li>About Us image retrieved from:
                            <a href="http://wallpaper.pickywallpapers.com/1920x1080/superheroes-christmas.jpg">Click Here</a></li>
                        
                        <li>Browse Books image retrieved from: 
                            <a href="https://pokemon.aminoapps.com/page/blog/merry-christmas-in-advance/Pjhm_uNZnRgrzEPmjp3oD8QR2lan0d">Click Here</a></li>
                            
                        <li>Browse Universities image retrieved from:  
                            <a href="https://vignette2.wikia.nocookie.net/epicrapbattlesofhistory/images/0/0d/Santas-workshop%2C-north-pole%2C-mountains%2C-fairy-tale-151750.jpg/revision/latest?cb=20150409091908">Click Here</a></li>
                        
                        <li>Analytics image retrieved from:  
                            <a href="https://celoxis.files.wordpress.com/2014/12/21.jpg">Click Here</a></li>

                        <li>Browse Employees image retrieved from: 
                           <a href="https://www.hdwallpapers.in/xmas_santa_minions-wallpapers.html">Click Here</a></li>
                                          
                        <li>Profile picture image retrieved from:
                          <a href="https://images2.alphacoders.com/804/804156.jpg">Click Here</a></li>
                          
                        <li>Background gif retrieved from:
                          <a href="https://media.giphy.com/media/MIiJ2fJ7l36jS/giphy.gif">Click Here</a></li>
                          
                        <li>Background music retrieved from: 
                          <a href="https://www.youtube.com/watch?v=pWBjl-jPcVM">Click Here</a></li>
                            
                    </ul>
                </div>
              </div>  
              </div>
              <div class="mdl-cell mdl-cell--8-col">
              <div class="mdl-cell mdl-cell--8-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">About Us</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                          <div class="mdl-tabs__tab-bar">
                              <a href="#haggai-panel" class="mdl-tabs__tab is-active">Haggai Lazaro</a>
                              <a href="#brandon-panel" class="mdl-tabs__tab">Brandon Lazurko</a>
                              <a href="#robert-panel" class="mdl-tabs__tab">Robert Rosica</a>
                          </div>
                        <div class="mdl-tabs__panel is-active" id="haggai-panel">
                          <ul class="demo-list-item mdl-list">
                            <li>Assignment 2 Functionality Updates</li>
                            <li>Mapping</li>
                            <li>Registering</li>
                            <li>Web Services</li>
                            <li>Debugging</li>
                            <li>Pushing to Github</li>
                            <li><a href="https://github.com/haggail">GitHub Account</a></li>
                          </ul>
                        </div>
                        
                        <div class="mdl-tabs__panel" id="brandon-panel">
                          <ul class="demo-list-item mdl-list">
                            <li>Assignment 2 Functonality Updates</li>
                            <li>Registering</li>
                            <li>Theme Change (colour pallet, background, music, etc)</li>
                            <li>Referencing</li>
                            <li>About Us</li>
                            <li>Debugging</li>
                            <li>Providing great music</li>
                            <li><a href="https://github.com/blazu">GitHub Account</a></li>
                          </ul>
                        </div>
                        
                        <div class="mdl-tabs__panel" id="robert-panel">
                          <ul class="demo-list-item mdl-list">
                            <li>Some Commenting, I think....</li>
                            <li><a href="">GitHub Account</a></li>
                          </ul>
                        </div>
                    </div>
            </div>  
            </div>
            
            </div>
            </div>
        </section>
    </main>    
</div>    
          
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
</html>
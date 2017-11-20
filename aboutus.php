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
                <div class="mdl-card__title mdl-color--red-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Disclaimer</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>This site is hypothetical and was created as an assignment for COMP 3512 at Mount Royal University taught by Randy Connolly</li>
                    </ul>
            </div>  
            </div>
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Resources</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>Course: COMP 3512</li>
                        <li>Current Date: <?php echo date("M d, Y"); ?></li>
                        <li>Github: </li>
                        <li>https://github.com/haggail/hlaza132-comp3512-assign2</li>
                        <li>----------------------------------------------------------------------------------------------------</li>
                        <li>Material Design Lite</li>
                        <li>Book Images</li>
                        <li>Liberal use of w3schools & stackoverflow</li>
                        <li>Randy Connolly</li>
                        <li>----------------------------------------------------------------------------------------------------</li>
                        <li>Profile image retrieved from: 
                            <a href="http://2.bp.blogspot.com/-vD7Uq2VksXs/U8SyF0X0feI/AAAAAAAAAzo/3Ca1stPBhJk/s1600/Linux+Hacker+Wallpaper+HD.png">Click Here</a></li>
                        <li>About Us image retrieved from:
                            <a href="http://www.guoguiyan.com/data/out/65/69974454-epic-wallpapers.jpg">Click Here</a></li>
                        <li>Browse Books image retrieved from: 
                            <a href="http://www.nmgncp.com/data/out/114/4536685-epic-wallpaper-and-screensavers.jpg">Click Here</a></li>
                        <li>Browse Universities image retrieved from:  
                            <a href="http://cdn.theoccultmuseum.com/wp-content/uploads/2016/06/7-Hauntingly-Beautiful-Abandoned-Castles-Around-The-World.jpg">Click Here</a></li>
                        <li>Analytics image retried from:  
                            <a href="http://insight.venturebeat.com/sites/default/files/marketing-analytics.png">Click Here</a></li>
                        <li>Browse Employees image retried from: 
                           <a href="http://cdn.cnn.com/cnnnext/dam/assets/170822235920-08-trump-phoenix-0822-exlarge-169.jpg">Click Here</a></li>
                        <li>Beer On the Moon image retried from: Brandons phone.</li>   
                            
                    </ul>
                </div>
              </div>  
              </div>
              <div class="mdl-cell mdl-cell--8-col">
              <div class="mdl-cell mdl-cell--8-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--deep-purple-900 mdl-color-text--white">
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
                            <li>Assignment 1 Functionality</li>
                            <li>Class-based Infrastructure</li>
                            <li>Single Book</li>
                            <li>Login/Logout</li>
                            <li>Browse Employee Filter</li>
                            <li>Header Employee Search</li>
                            <li>CSS improvements</li>
                          </ul>
                        </div>
                        
                        <div class="mdl-tabs__panel" id="brandon-panel">
                          <ul class="demo-list-item mdl-list">
                            <li>Assignment 1 Functionality</li>
                            <li>Class-based Infrastructure</li>
                            <li>Login/Logout</li>
                            <li>Left Navigation</li>
                            <li>Analytics/Profile Easter Egg</li>
                            <li>MDL Color Palette Improvement</li>
                            <li>Index images</li>
                          </ul>
                        </div>
                        
                        <div class="mdl-tabs__panel" id="robert-panel">
                          <ul class="demo-list-item mdl-list">
                            <li>Assignment 1 Functionality</li>
                            <li>Class-based Infrastructure</li>
                            <li>Browse Employee Filter</li>
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
</html>
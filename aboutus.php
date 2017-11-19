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
    <?php include 'includes/functions.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--red-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Disclaimer</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>This site is hypothetical and was created as an assignment for COMP 3512 at Mount Royal University taught by Randy Connolly</li>
                    </ul>
            </div>  
            </div>
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">About Us</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>Names: </li>
                        <li>Haggai Lazaro</li>
                        <li>Brandon Lazurko</li>
                        <li>Robert Rosica</li>
                        <br>
                        <li>Course: COMP 3512</li>
                        <br>
                        <li>Current Date: <?php echo date("M d, Y"); ?></li>
                        <br>
                        <li>Github: </li>
                        <li>https://github.com/haggail/hlaza132-comp3512-assign2</li>

                    </ul>
                </div>
              </div>  
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Resources</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                        <li>Material Design Lite</li>
                        <li>Book Images</li>
                    </ul>
            </div>  
            </div>
            
            <div class="mdl-layout-spacer"></div>
            </div>
        </section>
    </main>    
</div>    
          
</body>
</html>
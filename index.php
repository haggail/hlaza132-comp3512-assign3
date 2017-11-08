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
    <?php include 'includes/functions.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <table>
                <tr>
                    <td>
                        <a href="browse-universities.php">
                            <div class="dashboard-card mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand mdl-color--yellow">
                                    <h3>Browse Universities</h3>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="browse-books.php">
                            <div class="dashboard-card mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand mdl-color--orange">
                                    <h3>Browse Books</h3>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="browse-employees.php">
                            <div class="dashboard-card mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand mdl-color--deep-purple mdl-color-text--white">
                                    <h3>Browse Employees</h3>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="aboutus.php">
                            <div class="dashboard-card mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand mdl-color--yellow">
                                    <h3>About Us</h3>
                                </div>
                            </div>
                        </a>
                    </td> 
                    <td>
                        <a href="analytics.php">
                            <div class="dashboard-card mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand mdl-color--orange">
                                    <h3>Analytics</h3>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
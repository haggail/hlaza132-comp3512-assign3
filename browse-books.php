<?php
include 'includes/functions.inc.php';
session_start();
$check = checkSession();

// redirects to login if session state variables do not exist
if (!$check) {
    header("Location:login.php?prevurl=browse-books.php");
}

// if no filters set, redirects to the same page with query strings set to nothing
if (!isset($_GET['subid']) && !isset($_GET['imprintid'])) {
        header("Location:browse-books.php?subid=&imprintid=");
}

include 'includes/book-config.inc.php';

//gateway connections
$subcatDb = new SubcategoryGateway($connection);
$imprintDb = new ImprintGateway($connection);
$bookDb = new BookGatewayImprint($connection);
$bookDb2 = new BookGatewaySubcat($connection);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Books</title>
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
            <div class="mdl-cell mdl-cell--3-col">

              <!-- imprints card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--3-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--red-A700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Imprint</h2>
                </div>
                <div class="mdl-card__supporting-text">
                   
                    <ul class="demo-list-item mdl-list">
                        
                        <?php
                        
                        //prints all imprints
                        $imprints = $imprintDb->getAll(null, "Imprint");
                        
                        echo '<li><a href=?subid=' . $_GET['subid'] . '&imprintid=>All Imprints</li>';
                        foreach ($imprints as $row) {
                            echo '<li><a href=?subid=' . $_GET['subid'] . '&imprintid=' . $row['ImprintID'] . '>' . $row['Imprint'] . '</a></li>';
                        }
                        ?>
                
                    </ul>
                </div>
              </div>  <!-- subcategory card -->
              <div class="mdl-cell mdl-cell--top mdl-cell--3-col card-lesson mdl-card mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--red-A700 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Subcategory</h2>
                </div>
                <div class="mdl-card__supporting-text">
    
                    <ul class="demo-list-item mdl-list">
                        <?php
                        
                        //prints all subcategories
                        $subcategories = $subcatDb->getAll(null, "SubcategoryName");
                        
                        echo '<li><a href=?subid=&imprintid=' . $_GET['imprintid'] . '>All Subcategories</li>';
                        foreach ($subcategories as $row) {
                            echo '<li><a href=?subid=' . $row['SubcategoryID'] . '&imprintid=' . $_GET['imprintid'] . '>' . $row['SubcategoryName'] . '</a></li>';
                        }
                        ?>
                
                    </ul>
                        
                </div>
              </div> 
              </div>
              <div class="mdl-cell mdl-cell--9-col">
              <!-- book details card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--red-A700 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Book Details</h2>
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
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '><img src="/book-images/thumb/' . $row['ISBN10'] . '.jpg"></a></td>';
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '>' . $row['Title'] . '</a></td>';
                                            echo '<td>' . $row['CopyrightYear'] . '</td>';
                                            echo '<td>' . $row['SubcategoryName'] . '</td>';
                                            echo '<td>' . $row['Imprint'] . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                              </tbody>
                            </table>
                    </div>    
                    </div>
              </div>  <!-- / mdl-cell + mdl-card --> 
              
              
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
<embed src="IWasHiding/SiberianOrchestra-WizardsInWinter.mp3" loop="true"></embed>
</html>
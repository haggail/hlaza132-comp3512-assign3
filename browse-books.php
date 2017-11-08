<?php
if (isset($_GET['subid']) && isset($_GET['imprintid'])) {
    $allfilter = true;
} else {
    if (!isset($_GET['subid']) && !isset($_GET['imprintid'])) {
        header("Location:browse-books.php?subid=&imprintid=");
    } else {
    $allfilter = false;
    }
}

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
    <?php include 'includes/functions.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">
                
                <div class="mdl-cell mdl-cell--6-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--yellow">
                  <h2 class="mdl-card__title-text">Subcategory</h2>
                </div>
                <div class="mdl-card__supporting-text">
    
                    <ul class="demo-list-item mdl-list">
                        <?php  
                        $result = getDatabaseData("SELECT SubcategoryID, SubcategoryName FROM Subcategories ORDER BY SubcategoryName");

                        if ($allfilter) {
                            echo '<li><a href=?subid=&imprintid=' . $_GET['imprintid'] . '>All Subcategories</li>';
                            while ($row=$result->fetch()) {
                                echo '<li><a href=?subid=' . $row['SubcategoryID'] . '&imprintid=' . $_GET['imprintid'] . '>' . $row['SubcategoryName'] . '</a></li>';
                            }
                        } else {
                            echo '<li><a href=?subid=&imprintid=>All Subcategories</li>';
                            while ($row=$result->fetch()) {
                                echo '<li><a href=?subid=' . $_GET['subid'] . '>' . $row['SubcategoryName'] . '</a></li>';
                            }
                        }
                        
                        
                        
                        
                        ?>
                
                    </ul>
                        
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--6-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Imprint</h2>
                </div>
                <div class="mdl-card__supporting-text">
                   
                    <ul class="demo-list-item mdl-list">
                        <?php
                        $result = getDatabaseData("SELECT ImprintID, Imprint FROM Imprints ORDER BY Imprint");
                        
                        if ($allfilter) {
                            echo '<li><a href=?subid=' . $_GET['subid'] . '&imprintid=>All Imprints</li>';
                            while ($row=$result->fetch()) {
                                echo '<li><a href=?subid=' . $_GET['subid'] . '&imprintid=' . $row['ImprintID'] . '>' . $row['Imprint'] . '</a></li>';
                            }
                        } else {
                            echo '<li><a href=?subid=&imprintid=' . $_GET['imprintid'] . '>All Imprints</li>';
                            while ($row=$result->fetch()) {
                                echo '<li><a href=?subid=&imprintid=' . $row['ImprintID'] . '>' . $row['Imprint'] . '</a></li>';
                            }
                        }
                        ?>
                
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Book Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                                    <?php
                                    
                                    if ($_GET['subid']=='') {
                                        if ($_GET['imprintid']=='') {
                                            $result = getDatabaseData("SELECT BookID, ISBN10, Title, CopyrightYear, SubcategoryID, ImprintID FROM Books LIMIT 20");
                                        } else {
                                            $result = getDatabaseData("SELECT BookID, ISBN10, Title, CopyrightYear, SubcategoryID, ImprintID FROM Books WHERE ImprintID = " . $_GET['imprintid'] . " LIMIT 20");
                                        }
                                    } else {
                                         if ($_GET['imprintid']=='') {
                                            $result = getDatabaseData("SELECT BookID, ISBN10, Title, CopyrightYear, SubcategoryID, ImprintID FROM Books WHERE SubcategoryID = " . $_GET['subid'] . " LIMIT 20");
                                        } else {
                                            $result = getDatabaseData("SELECT BookID, ISBN10, Title, CopyrightYear, SubcategoryID, ImprintID FROM Books WHERE SubcategoryID = " . $_GET['subid'] . " AND ImprintID = " . $_GET['imprintid'] . " LIMIT 20");
                                        }
                                     }
                                    
                                    if (!$result) {
                                        echo 'Could not retrieve data. Please try selecting a filter or book.';
                                    } else {
                                        echo '<table class="mdl-data-table  mdl-shadow--2dp">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th>Cover</th>';
                                        echo '<th class="mdl-data-table__cell--non-numeric">Title</th>';
                                        echo '<th>Year</th>';
                                        echo '<th>Subcategory</th>';
                                        echo '<th>Imprint</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        
                                    while ($row=$result->fetch()) {
                                        echo '<tr>';
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '><img src="/book-images/thumb/' . $row['ISBN10'] . '.jpg"></a></th>';
                                            echo '<td><a href=single-book.php?isbn10=' . $row['ISBN10'] . '>' . $row['Title'] . '</a></th>';
                                            echo '<td>' . $row['CopyrightYear'] . '</th>';
                                            echo '<td>' . $row['SubcategoryID'] . '</th>';
                                            echo '<td>' . $row['ImprintID'] . '</th>';
                                            echo '</tr>';
                                    }
                                    }
                                    ?>

                              </tbody>
                 
                
                            </table>
                        
                    
                                                 
                    </div>    
  
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
<?php
if (isset($_GET['isbn10'])) {
    $nobook = false;
} else {
    $nobook = true;
}

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
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    <?php include 'includes/functions.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Book Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                        <?php
                        $result = getDatabaseData('SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryName, Imprint, Status, BindingType, TrimSize, PageCountsEditorialEst, Description 
                        FROM Books JOIN BindingTypes USING(BindingTypeID) JOIN Statuses JOIN Subcategories USING(SubcategoryID) JOIN Imprints USING(ImprintID)
                        WHERE ProductionStatusID = StatusID AND ISBN10= "'. $_GET['isbn10'] . '"');
                        
                        if (!$result) {
                            echo 'Could not retrieve data. Please try selecting a book.';
                        } else {

                        while ($row=$result->fetch()) {
      
                            echo '<img src="/book-images/medium/' . $row['ISBN10'] . '.jpg"><br><br>';
                            echo 'Title: ' . $row['Title'] . '<br><br>';
                            echo 'Description: ' . $row['Description'] . '<br><br>';
                            echo 'ISBN10: ' . $row['ISBN10'] . '<br><br>';
                            echo 'ISBN13: ' . $row['ISBN13'] . '<br><br>';
                            echo 'Copyright Year: ' .$row['CopyrightYear']. '<br><br>';
                            echo 'Subcategory: ' .$row['SubcategoryName']. '<br><br>';
                            echo 'Imprint: ' .$row['Imprint'] . '<br><br>';
                            echo 'Production Status: ' . $row['Status'] . '<br><br>';
                            echo 'Binding Type: ' . $row['BindingType'] . '<br><br>';
                            echo 'Trim Size: ' . $row['TrimSize'] . '<br><br>';
                            echo 'Page Count: ' . $row['PageCountsEditorialEst'] . '<br><br>';
                        }
                        }
                        ?>

                    </div>    
  
                 
              </div>  
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Authors</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">

                    <?php
                    $result = getDatabaseData('SELECT FirstName, LastName 
                    FROM Books JOIN BookAuthors JOIN Authors
                    WHERE Books.BookID = BookAuthors.BookId AND BookAuthors.AuthorId = Authors.AuthorID AND ISBN10 = "'. $_GET['isbn10'] . '" ORDER BY BookAuthors.Order');
                    
                    if (!$result) {
                        echo 'Could not retrieve data. Please try selecting a book.';
                    } else {
                    while ($row=$result->fetch()) {
                        echo '<li>' . $row['FirstName'] . ' ' . $row['LastName'] . '</li>';
                    }
                    }
                    ?>
                    
                    </ul>
    
                    </div>
              </div> 
              
              <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Adopted by Universities</h2>
                </div>
                <div class="mdl-card__supporting-text">

                    <ul class="demo-list-item mdl-list">

                    <?php
                    $result = getDatabaseData('SELECT Name 
                    FROM Books JOIN AdoptionBooks USING (BookID) JOIN Adoptions USING (AdoptionID) JOIN Universities USING (UniversityID)
                    WHERE ISBN10 = "'. $_GET['isbn10'] . '"');

                    if (!$result) {
                        echo 'Could not retrieve data. Please try selecting a book.';
                    } else {
                    while ($row=$result->fetch()) {
                        echo '<li>' . $row['Name'] . '</li>';
                    }
                    }
                    ?>
                    
                    </ul>
                </div>
              </div>  
              
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
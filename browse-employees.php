<?php
session_start();

include 'includes/functions.inc.php';

$check = checkSession();

// redirects to login if session state variables do not exist
if (!$check) {
    header("Location:login.php?prevurl=browse-employees.php");
}

$noFilter = false; $nameFilter = false; $cityFilter = false; $bothFilter = false;

// if searching employees through the header search, redirects
// to page with added filter
if (isset($_GET['lastName']) && !isset($_GET['city'])) {
    header("Location:browse-employees.php?lastName=" . $_GET['lastName'] . "&city=");
} else if (isset($_GET['lastName']) || isset($_GET['city'])) {
    //if both filters are set, do nothing
    //otherwise redirect to page with no filters added
} else {
    header("Location:browse-employees.php?lastName=&city=");
}

include 'includes/book-config.inc.php';

// gateway connections
$empDb = new EmployeeGateway($connection);
$empMsgs = new EmployeeMsgsGateway($connection);
$empToDoDb = new EmployeeToDoGateway($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Employees</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

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
                <!-- show/hide filter card -->
              <div class="mdl-cell mdl-cell--3-col">
                    
                    
              <div class="mdl-cell card-lesson mdl-card mdl-shadow--2dp cardWidth" >
                <div class="mdl-card__title mdl-color--indigo-900 mdl-color-text--white" id="filter" >
                  <h2 class="mdl-card__title-text">Show/Hide Filter</h2>
                </div>
                <div class="mdl-card__supporting-text" style="visibility:hidden;" id="filterList">
                        <form action="browse-employees.php" method="get">
                             
                        Search by last name: <br>
                        <input type="text" id="lastNameTextBox" name="lastName"><br><br>
                        
                        Search by city: <br>
                        <select name="city">
                            <option value="">All Cities</option>
                            <?php
                            $cities = $empDb->getAll("City", "City");
                            
                            foreach ($cities as $row) {
                                echo '<option value="' . $row['City'] . '">' . $row['City'] . '</option>';
                            }
                            
                            ?>
                        </select><br><br>
                        <input type="submit" value="Filter">
                    </form>     
                </div>
                <script>
                // click event for filter: shows/hides filter
                    var visible = false;
                    var toggle = document.querySelector("#filter");
                    toggle.addEventListener("click", function() {
                    if (visible) {
                        document.querySelector("#filterList").style.visibility='hidden';
                        visible = false;
                    } else {
                        document.querySelector("#filterList").style.visibility='visible';
                        visible = true;
                    }
                    });
                </script>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- employees card-->
              <div class="mdl-cell mdl-cell card-lesson mdl-card  mdl-shadow--2dp cardWidth">
                <div class="mdl-card__title mdl-color--blue-900 mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                         <?php  
                                //checks filters and uses the correct sql statement
                                  if ($_GET['lastName'] == '' && $_GET['city'] == '') {
                                      $employees=$empDb->getAll(null, "LastName");
                                      $noFilter = true;
                                  } else if ($_GET['lastName'] != '' && $_GET['city'] == '') {
                                      $employees=$empDb->matchData($_GET['lastName'], "LastName");
                                      $nameFilter = true;
                                  } else if ($_GET['lastName'] == '' && $_GET['city'] != '') {
                                      $employees=$empDb->matchData2($_GET['city'], "City");
                                      $cityFilter = true;
                                  } else if ($_GET['lastName'] != '' && $_GET['city'] != '') {
                                      $employees=$empDb->match2Key($_GET['lastName'], $_GET['city'], null, "LastName");
                                      $bothFilter = true;
                                  }

                                // if no employees found, display message
                                // otherwise display employee names depending on filters
                                  if (empty($employees)) {
                                      echo 'Filter returned 0 results.';
                                  } else {
                                    if ($noFilter) {
                                        foreach ($employees as $row) {
                                            echo '<li><a href=?employeeid=' . $row['EmployeeID'] . '&lastName=&city=>' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
                                        }
                                    } else if ($nameFilter) {
                                        foreach ($employees as $row) {
                                            echo '<li><a href=?employeeid=' . $row['EmployeeID'] . '&lastName=' . $row['LastName'] . '&city=>' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
                                        }
                                    } else if ($cityFilter) {
                                        foreach ($employees as $row) {
                                            echo '<li><a href=?employeeid=' . $row['EmployeeID'] . '&lastName=&city=' . $row['City'] . '>' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
                                        }
                                    } else if ($bothFilter) {
                                        foreach ($employees as $row) {
                                            echo '<li><a href=?employeeid=' . $row['EmployeeID'] . '&lastName=' . $row['LastName'] . '&city=' . $row['City'] . '>' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
                                        }
                                    }
                                  }
                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              </div> <!-- mdl cell -->
            <div class="mdl-cell mdl-cell--9-col">
              <!--employee details card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp cardWidth">

                    <div class="mdl-card__title mdl-color--deep-purple-900 mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text overflow">
                        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                          <div class="mdl-tabs__tab-bar">
                              <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a>
                              <a href="#todo-panel" class="mdl-tabs__tab">To Do</a>
                              <a href="#messages-panel" class="mdl-tabs__tab">Messages</a>
                          </div>
                        
                          <div class="mdl-tabs__panel is-active" id="address-panel">
                              
                           <?php   
                             /* display requested employee's information */
                             
                             if (!isset($_GET['employeeid'])) {
                                 echo 'No employee selected. Please select employee.';
                             } else {
                                 $employees = $empDb->getByKey($_GET['employeeid']);
                             
                                 if (empty($employees)) {
                                     echo 'Could not retrieve data. Please try again.';
                                 } else {
                                     echo '<h3>' . $employees['FirstName'] . ' ' . $employees['LastName'] . '</h3>';
                                     echo $employees['Address'] . '<br>';
                                     echo $employees['City']. ', ' . $employees['Region'] . '<br>';
                                     echo $employees['Country']. ', ' . $employees['Postal'] . '<br>';
                                     echo $employees['Email'];
                                 } 
                             }
                           ?>
                           
         
                          </div>
                          <div class="mdl-tabs__panel" id="todo-panel">
                            
                                <table class="mdl-data-table  mdl-shadow--2dp alignLeft">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Status</th>
                                      <th>Priority</th>
                                      <th>Content</th>
                                    </tr>
                                  </thead>
                                  
                                  <tbody>
                                   
                                    <?php /*  display TODOs  */ 
                                    
                                    if (!isset($_GET['employeeid'])) {
                                        echo 'No employee selected. Please select employee.';
                                    } else {
                                        $toDo = $empToDoDb->matchData($_GET['employeeid'], "DateBy");
                                        if (empty($toDo)) {
                                            echo 'Could not retrieve data. Please try again.';
                                        } else {
                                            foreach ($toDo as $row){
                                            echo '<tr>';
                                            echo '<td>' . $row['DateBy'] . '</td>';
                                            echo '<td>' . $row['Status'] . '</td>';
                                            echo '<td>' . $row['Priority'] . '</td>';
                                            echo '<td>' . $row['Description'] . '</td>';
                                            echo '</tr>';
                                            }
                                        }
                                    }
                                    
                                    ?>
                            
                                  </tbody>
                                </table>
                           
         
                          </div>
                          
                          <div class="mdl-tabs__panel" id="messages-panel">
                              
                              <table class="mdl-data-table  mdl-shadow--2dp alignLeft">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Category</th>
                                      <th class="mdl-data-table__cell--non-numeric">From</th>
                                      <th class="mdl-data-table__cell--non-numeric">Message</th>
                                    </tr>
                                  </thead>
                                  
                                  <tbody>
                                   
                                    <?php /*  display Messages  */ 
                                    if (!isset($_GET['employeeid'])) {
                                        echo 'No employee selected. Please select employee.';
                                    } else {
                                        $employees = $empMsgs->matchData($_GET['employeeid'], "MessageDate");
                                        if (empty($employees)) {
                                                echo 'Could not retrieve data. Please try again.';
                                            } else {
                                                foreach ($employees as $row) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['MessageDate'] . '</td>';
                                                    echo '<td>' . $row['Category'] . '</td>';
                                                    echo '<td>' . $row['FirstName'] . " " . $row['LastName'] . '</td>';
                                                    echo '<td>' . $row['Content'] . '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                    }
                                    ?>
                            
                                  </tbody>
                                </table>
                              
                          </div>
                          
                          </div>
                        </div>                         
                    </div>    
            </div>
        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
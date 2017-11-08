<?php
include 'includes/book-config.inc.php';

$empDb = new EmployeeGateway($connection);



$empToDoDb = new EmployeeToDoGateway($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Employees</title>
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

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">

                         <?php  
                           /* programmatically loop though employees and display each
                              name as <li> element. */
                             
                              $employees = $empDb->getAll("LastName");
                              
                              foreach ($employees as $row) {
                                  echo '<li><a href=?employeeid=' . $row['EmployeeID'] . '>' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li>';
                              }
                         ?>            

                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
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

                                 echo '<h3>' . $employees['FirstName'] . ' ' . $employees['LastName'] . '</h3>';
                                 echo $employees['Address'] . '<br>';
                                 echo $employees['City']. ', ' . $employees['Region'] . '<br>';
                                 echo $employees['Country']. ', ' . $employees['Postal'] . '<br>';
                                 echo $employees['Email'];
                             } 
                           ?>
                           
         
                          </div>
                          <div class="mdl-tabs__panel" id="todo-panel">
                              
                               <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */

                               ?>                                  
                            
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Status</th>
                                      <th class="mdl-data-table__cell--non-numeric">Priority</th>
                                      <th class="mdl-data-table__cell--non-numeric">Content</th>
                                    </tr>
                                  </thead>
                                  
                                  <tbody>
                                   
                                    <?php /*  display TODOs  */ 
                                    //$result = getDatabaseData("select Status, Priority, DateBy, Description from EmployeeToDo where EmployeeID=" . $_GET['employeeid'] . " order by DateBy");
                                    
                                    
                                    
                                    if (!isset($_GET['employeeid'])) {
                                        echo 'No employee selected. Please select employee.';
                                    } else {
                                        $toDo = $empToDoDb->matchData($_GET['employeeid']);
                                        
                                        //testing - delete later
                                        
                                        /*
                                        
                                        This works but it's weird and would require if statements for each conditional key
                                        
                                        foreach($toDo as $x => $x_val){
                                            echo "Key=" . $x . ", Value=" . $x_val;
                                             echo "<br>";
                                        }
                                        Key=ToDoID, Value=21
                                        Key=0, Value=21
                                        Key=EmployeeID, Value=32
                                        Key=1, Value=32
                                        Key=Status, Value=pending
                                        Key=2, Value=pending
                                        Key=Priority, Value=medium
                                        Key=3, Value=medium
                                        Key=DateBy, Value=2017-02-16 00:00:00
                                        Key=4, Value=2017-02-16 00:00:00
                                        Key=Description, Value=Duis mattis egestas metus.
                                        Key=5, Value=Duis mattis egestas metus
                                    

                                            //works                         
                                        echo $_GET['employeeid'] . "<br>";
                                        
                                        echo $toDo['ToDoID'] . "<br>";
                                        echo $toDo['EmployeeID'] . "<br>";
                                        echo $toDo['DateBy'] . "<br>"; 
                                        echo $toDo['Status'] . "<br>";
                                        echo $toDo['Priority'] . "<br>"; 
                                        echo $toDo['Description'] . "<br>"; 
                                   */
                                    echo "<br>";
                                    foreach($toDo as $x => $x_val){
                                            echo "Key=" . $x . ", Value=" . $x_val;
                                             echo "<br>";
                                    }
                                   
                                        //works, but only displays the first of the $toDo's
                                        echo "<br> size of array: " . sizeof($toDo);
                                    for($i=0;$i<sizeof($toDo);$i++){
                                        echo '<tr>';
                                        echo '<td>' . $toDo['DateBy'] . '</td>';
                                        echo '<td>' . $toDo['Status'] . '</td>';
                                        echo '<td>' . $toDo['Priority'] . '</td>';
                                        echo '<td>' . $toDo['Description'] . '</td>';
                                        echo '</tr>';
                                    }
                                        
                                   /*     
                                        foreach ($toDo as $row){
                                        echo '<tr>';
                                        echo '<td>' . $row['DateBy'] . '</td>';
                                        echo '<td>' . $row['Status'] . '</td>';
                                        echo '<td>' . $row['Priority'] . '</td>';
                                        echo '<td>' . $row['Description'] . '</td>';
                                        echo '</tr>';
                                        }*/
                                        
                                }
                                    
                                    ?>
                            
                                  </tbody>
                                </table>
                           
         
                          </div>
                          
                          <div class="mdl-tabs__panel" id="messages-panel">
                              
                               <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */
                               ?>  
                              
                              <table class="mdl-data-table  mdl-shadow--2dp">
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
                                        $employees = getToDoSelectStatement($_GET['employeeid']);
                                    
                                        
                                    foreach ($toDo as $row) {
                                        echo '<tr>';
                                        echo '<td>' . $row['MessageDate'] . '</td>';
                                        echo '<td>' . $row['Category'] . '</td>';
                                        echo '<td>' . $row['FirstName'] . " " . $row['FirstName'] . '</td>';
                                        echo '<td>' . $row['Content'] . '</td>';
                                        echo '</tr>';
                                    }
                                    }
                                    
                                    ?>
                            
                                  </tbody>
                                </table>
                              
                          </div>
                          
                          
                        </div>                         
                    </div>    
  
                 
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
          
</body>
</html>
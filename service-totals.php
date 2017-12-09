<?php
//web services for totals
include 'includes/book-config.inc.php';

header('Content-Type:application/json');

$visitsDb = new BookVisitsGateway2($connection);
$toDoDb = new AnalyticsEmployeeToDoGateway($connection);
$messagesDb = new AnalyticsEmployeeMsgsGateway($connection);

$visitCount = 0;
$countries = 0;
$toDos = 0;
$messages = 0;

//counts visits
$visits = $visitsDb->getAll();
foreach ($visits as $row) {
    $visitCount += $row['Visits'];
}
$totals['Visits'] = $visitCount; 

//counts countries
$sumCountries = $visitsDb->getAll();
foreach($sumCountries as $row) {
    $countries++;
}
$totals['CountryCount'] = $countries; 

//counts to dos
$toDoCount = $toDoDb->getAll();
foreach ($toDoCount as $row) {
    $toDos = $row['ToDoCount'];
}
$totals['ToDoCount'] = $toDos; 

//counts messages
$messageCount = $messagesDb->getAll();
foreach ($messageCount as $row) {
    $messages = $row['MessageCount'];
}
$totals['MessageCount'] = $messages; 


echo json_encode($totals)
?>

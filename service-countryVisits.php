<?php
//web services for country visits
include 'includes/book-config.inc.php';

header('Content-Type:application/json');

$countries = new BookVisitsGateway($connection);

$top = $countries->getAll();

echo json_encode($top);
?>
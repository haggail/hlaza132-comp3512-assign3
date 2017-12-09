<?php
include 'includes/book-config.inc.php';

header('Content-Type:application/json');

$adoptBooksDb = new AdoptionBooksGateway($connection);

$topBooks = $adoptBooksDb->getAll();

echo json_encode($topBooks);
?>
<?php
//web services for top adopted books
include 'includes/book-config.inc.php';

header('Content-Type:application/json');

$adoptBooksDb = new AdoptionBooksGateway($connection);

$topBooks = $adoptBooksDb->getAll();

echo json_encode($topBooks);
?>
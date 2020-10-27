<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/books.php';

// Connect to DB
$database = new Database();
$db = $database->connect();

// Books object
$books = new Books($db);

// read query books
$result = $books->getBooks();

// Get row count
$rowCount = $result->rowCount();

// Check if there is any books
if ($rowCount > 0) {
  $books_arr['data'] = array();

  // loop the result
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // use extract() to get values as variables
    extract($row);

    $book_item = array(
      'id' => $id,
      'title' => $title,
      'isbn' => $isbn,
      'description' => $description
    );

    // Push to book arr in 'data'
    array_push($books_arr['data'], $book_item);
  }

  echo json_encode($books_arr);
} else {
  // No books
  echo json_encode(array('message' => 'No books found!'));
}
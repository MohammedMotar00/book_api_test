<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/authors.php';

// Connect to DB
$database = new Database();
$db = $database->connect();

// Authors object
$authors = new Authors($db);

// read query books
$result = $authors->getAuthors();

// Get row count
$rowCount = $result->rowCount();

// Check if there is any books
if ($rowCount > 0) {
  // Books array
  // $books_arr;
  $authors_arr['data'] = array();

  // loop the result
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // use extract() to get values as variables
    extract($row);

    $author_item = array(
      'id' => $id,
      'name' => $name,
      'biography' => $biography,
    );

    // Push to book arr in 'data'
    array_push($authors_arr['data'], $author_item);
  }

  echo json_encode($authors_arr);
} else {
  // No books
  echo json_encode(array('message' => 'No books found!'));
}
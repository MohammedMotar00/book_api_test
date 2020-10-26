<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/genres.php';

// Connect to DB
$database = new Database();
$db = $database->connect();

// genres object
$genres = new Genres($db);

// read query books
$result = $genres->getGenres();

// Get row count
$rowCount = $result->rowCount();

// Check if there is any books
if ($rowCount > 0) {
  // $books_arr;
  $genres_arr['data'] = array();

  // loop the result
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // use extract() to get values as variables
    extract($row);

    $genres_item = array(
      'id' => $id,
      'name' => $name
    );

    // Push to book arr in 'data'
    array_push($genres_arr['data'], $genres_item);
  }

  echo json_encode($genres_arr);
} else {
  // No books
  echo json_encode(array('message' => 'No books found!'));
}
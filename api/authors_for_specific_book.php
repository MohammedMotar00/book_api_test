<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/authors_for_specific_book.php';

$database = new Database();
$db = $database->connect();

$author_books = new AuthorsForSpecificBook($db);

$author_books->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single author
$result = $author_books->author_books();

$rowCount = $result->rowCount();

if ($rowCount > 0) {
  $author_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $author_item = array(
      'name' => $name,
    );

    array_push($author_arr['data'], $author_item);
  }

  echo json_encode($author_arr);
} else {
  echo json_encode(array('message' => 'There is no author for this book!'));
}
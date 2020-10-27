<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/books_for_specific_author.php';

$database = new Database();
$db = $database->connect();

$books_author = new BooksForSpecificAuthor($db);

$books_author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$result = $books_author->books_author();

$rowCount = $result->rowCount();

if ($rowCount > 0) {
  $books_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $book_item = array(
      'title' => $title,
      'isbn' => $isbn,
      'description' => $description
    );

    array_push($books_arr['data'], $book_item);
  }

  echo json_encode($books_arr);
} else {
  echo json_encode(array('message' => 'Book not found!'));
}
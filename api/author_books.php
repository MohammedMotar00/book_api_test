<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/author_books.php';

$database = new Database();
$db = $database->connect();

$author_books = new AuthorBooks($db);

$author_books->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$result = $author_books->author_books();

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
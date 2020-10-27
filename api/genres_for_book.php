<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/genres_for_book.php';

$database = new Database();
$db = $database->connect();

$books_genres = new BooksGenres($db);

$books_genres->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$result = $books_genres->books_genres();

$rowCount = $result->rowCount();

if ($rowCount > 0) {
  $genres_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $genres_item = array(
      'genre' => $name,
    );

    array_push($genres_arr['data'], $genres_item);
  }

  echo json_encode($genres_arr);
} else {
  echo json_encode(array('message' => 'Book not found!'));
}
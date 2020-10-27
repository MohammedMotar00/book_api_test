<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$book->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$book->single_book();

// create array
$book_arr = array(
  'id' => $book->id,
  'title' => $book->title,
  'isbn' => $book->isbn,
  'description' => $book->description,
);

// JSON
echo json_encode($book_arr);
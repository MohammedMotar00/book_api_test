<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$author->single_author();

// create array
$author_arr = array(
  'id' => $author->id,
  'name' => $author->name,
  'biography' => $author->biography,
);

// JSON
echo json_encode($author_arr);
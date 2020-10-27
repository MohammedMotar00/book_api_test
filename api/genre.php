<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../types/genre.php';

$database = new Database();
$db = $database->connect();

$genre = new Genre($db);

$genre->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single book
$genre->single_genre();

// create array
$genre_arr = array(
  'id' => $genre->id,
  'name' => $genre->name,
);

// JSON
echo json_encode($genre_arr);
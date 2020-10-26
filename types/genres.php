<?php

class Genres
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // DB stuff
  private $conn;
  private $table = 'genres';

  public $id;
  public $name;

  // Get books
  public function getGenres()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }
}
<?php

class Books
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // DB stuff
  private $conn;
  private $table = 'books';

  // Get books
  public function getBooks()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }
}
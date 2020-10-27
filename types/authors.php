<?php

class Authors
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // DB stuff
  private $conn;
  private $table = 'authors';

  // Get books
  public function getAuthors()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }
}
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

  public $id;
  public $title;
  public $isbn;
  public $description;

  // Get books
  public function getBooks()
  {
    // Create query
    $query = 'SELECT id, title, isbn, description FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }
}
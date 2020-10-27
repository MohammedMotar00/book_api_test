<?php
class Book
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  private $conn;
  private $table = 'books';

  public $id;
  public $title;
  public $isbn;
  public $description;

  public function single_book()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID to id
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->title = $row['title'];
    $this->isbn = $row['isbn'];
    $this->description = $row['description'];
  }
}
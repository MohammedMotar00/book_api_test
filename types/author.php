<?php
class Author
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  private $conn;
  private $table = 'authors';

  public $id;
  public $name;
  public $biography;

  public function single_author()
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
    $this->name = $row['name'];
    $this->biography = $row['biography'];
  }
}
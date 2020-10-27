<?php
class BooksGenres
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  private $conn;
  private $table = 'books_genres';

  public $id;

  public function books_genres()
  {
    $query =
      'SELECT
        *
      FROM
        ' . $this->table . '
      LEFT JOIN
        genres g ON genre_id = g.id
      WHERE book_id = ?
    ';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind stmt
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    // Set properties
    return $stmt;
  }
}
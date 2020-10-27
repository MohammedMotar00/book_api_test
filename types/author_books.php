<?php
class AuthorBooks
{
  public function __construct($db)
  {
    $this->conn = $db;
  }

  private $conn;
  private $table = 'authors_books';

  public $id;

  public function author_books()
  {
    $query =
      'SELECT
        *
      FROM
        ' . $this->table . '
      LEFT JOIN
        books b ON book_id = b.id
      WHERE author_id = ?
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
<?php

class Database
{
  private $host = 'localhost';
  private $db_name = 'book_api_test';
  private $username = 'mohammed';
  private $password = 'motar12345';
  private $conn;

  // DB connect
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $err) {
      echo 'Connection Error: ' . $err->getMessage();
    }

    return $this->conn;
  }
}
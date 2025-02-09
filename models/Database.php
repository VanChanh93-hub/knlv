<?php
class Database
{
  private $servername = 'localhost';
  private $database = 'knlv';
  private $username = 'root';
  private $password = '';
  private $charset = "utf8mb4";
  private $pdo;

  public function __construct()
  {
    try {
      $dsn = "mysql:host=$this->servername;dbname=$this->database;charset=$this->charset";
      $this->pdo = new PDO($dsn, $this->username, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function query($sql, $param = [])
  {
    $stmt = $this->pdo->prepare($sql);
    if ($param) {
      $stmt->execute($param);
    } else {
      $stmt->execute();
    }
    return $stmt;
  }
  // getAll($sql, $MaTK, $MaDM,....)
  public function getAll($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($sql,)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $this->query($sql, $param);
    return $this->pdo->lastInsertId();
  }

  public function update($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }

  public function delete($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }

  public function __destruct()
  {
    unset($this->pdo);
  }
}

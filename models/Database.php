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

  public function query($sql, $params = []) {
    try {
        $stmt = $this->pdo->prepare($sql);

        // Ép tham số về dạng mảng nếu cần
        if (!is_array($params)) {
            $params = [$params];
        }

        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


  // getAll($sql, $MaTK, $MaDM,....)
  public function getAll($sql, $params = []) {
    // Truyền $params dưới dạng mảng
    $stmt = $this->query($sql, $params);
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

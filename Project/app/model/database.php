<?php

class Database{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "webbanhang";
  public $conn;
  private $stmt;
  function connect(){
      try {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
    }

  }
  function __construct()
  {
      try {
          $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
      } catch (PDOException $e) {
          echo "Kết nối thất bại: " . $e->getMessage();
      }
  }
  function getAll($sql){
    $this->stmt=$this->conn->prepare($sql);
    $this->stmt->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  function getOne($sql){
    $statement=$this->query($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  function query($sql, $param=[]){
    $this->stmt=$this->conn->prepare($sql);
    $this->stmt->execute($param);
    return $this->stmt;
  }
  public function getProducts()
  {
      $stmt = $this->conn->query("SELECT * FROM product");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function closeConnection()
  {
      $this->conn = null;
  }
  public function getCart()
  {
      $stmt = $this->conn->query("SELECT * FROM sanpham");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getCategory()
  {
      $stmt = $this->conn->query("SELECT * FROM category");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  function deleteSanPham() {
    $stmt = $this->conn->query("DELETE FROM sanpham");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



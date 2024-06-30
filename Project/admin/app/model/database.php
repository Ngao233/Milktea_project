<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "webbanhang";
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }
    }
    

    public function getAll($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function countInv() {
        $database = new Database();
        $conn = $database->conn;
    
        $sql = "SELECT COUNT(*) AS count FROM product WHERE inv < 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['count'];
        } else {
            return 0;
        }
    }
      
    function countOrder() {
        $database = new Database();
        $conn = $database->conn;
    
        $sql = "SELECT COUNT(*) AS da FROM donhang WHERE trangthai = 'Đã giao'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['da'];
        } else {
            return 0;
        }
    }
    function countOrderNot() {
        $database = new Database();
        $conn = $database->conn;
    
        $sql = "SELECT COUNT(*) as dang FROM donhang WHERE trangthai = 'Chưa giao'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['dang'];
        } else {
            return 0;
        }
    }
    function allDayRevenue(){
        $database = new Database();
        $conn = $database->conn;
    
        $sql =  "SELECT SUM(tongGiaTri) AS revenue_today FROM donhang WHERE trangthai = 'Đã giao'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['revenue_today'];
        } else {
            return 0;
        }
        
    }
}
?>

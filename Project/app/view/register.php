<link rel="stylesheet" href="./public/css/signin.css">

<center><h1>Đăng ký</h1></center>
<br>
<form method="POST" action="">
    <label for="username">Tài khoản:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="sdt">Số Điện Thoại:</label>
<input type="text" id="sdt" name="sdt" required pattern="0[0-9]{9}" title="Số điện thoại phải bắt đầu bằng số 0 và có tổng cộng 10 số.">


<?php

$db = new Database;
$db->__construct();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $sdt = $_POST['sdt'] ?? ''; 

    if ($username && $password && $sdt) { 
        try {
            $stmt = $db->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 'Tên người dùng đã tồn tại.';
            } else {
                $stmt = $db->conn->prepare("INSERT INTO users (username, password, sdt) VALUES (:username, :password, :sdt)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':sdt', $sdt);
                $stmt->execute();
            
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            }
            
        } catch(PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo 'Vui lòng điền đầy đủ thông tin.';
    }
}
?>
</br>
    <input class="login-button" type="submit" name="submit" value="Đăng ký"><br>
</form>
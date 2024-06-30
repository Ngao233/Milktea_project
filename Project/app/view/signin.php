<link rel="stylesheet" href="./public/css/signin.css">
<br>
<center><h1>ĐĂNG NHẬP</h1></center>
<br>
<form method="POST" action="">
    <label for="username">Tài khoản:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required><br><br>
    <?php
    session_start();    
    $db = new Database;
    $db->__construct();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $error = '';

        if ($username && $password) {
            try {
                $stmt = $db->conn->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($password == $user['password']) {
                        $_SESSION['username'] = $username;
                        
                        if ($user['admin'] == 1) {
                            $_SESSION['admin'] = 1;
                        }
                        
                        header('Location: ./admin/index.php');
                        exit;
                    } else {
                        $error = 'Mật khẩu không đúng.';
                    }
                } else {
                    $error = 'Tên người dùng không tồn tại.';
                }
            } catch(PDOException $e) {
                $error = "Lỗi: " . $e->getMessage();
            }
        } else {
            $error = 'Vui lòng điền đầy đủ thông tin.';
        }

        // Nếu có lỗi, hiển thị thông báo lỗi
        if (!empty($error)) {
            echo $error;
        }
    }

    ?>
    <input class="login-button" type="submit" name="submit" value="Đăng nhập"><br>
</form>

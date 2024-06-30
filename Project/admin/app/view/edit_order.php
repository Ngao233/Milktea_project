<?php

require_once('app/model/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=signin");
    exit();
}

$db = new Database();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = intval($_GET['id']);

    $sql = "SELECT * FROM donhang WHERE id = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "Đơn hàng không tồn tại.";
        exit();
    }
} else {
    echo "ID đơn hàng không hợp lệ.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order'])) {
    $username = $_POST['username'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $soSP = $_POST['soSP'];
    $price = $_POST['price'];
    $process = $_POST['process'];
    try {
        $sql_update = "UPDATE donhang SET tenKhach = ?, sdt = ?, diachi = ?, soSP = ?, tongGiaTri = ?, trangthai=? WHERE id = ?";
        $stmt = $db->conn->prepare($sql_update);
        $stmt->execute([$username, $number, $address, $soSP, $price,$process, $order_id]);

        echo "Sản phẩm đã được cập nhật thành công.";
        header("Location: index.php?action=order"); 
        exit();
    } catch (PDOException $e) {
        echo "Lỗi khi cập nhật sản phẩm: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa đơn hàng</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <style>
       h2 {
            margin-top: 30px; 
            text-align: center;
            font-size: 1.5em;
        }

        .table-container {
            margin-top: 20px; 
            overflow-x: auto; 
        }

        .admin-panel > div {
            padding: 20px; 
        }
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #4CAF50; 
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn:hover {
            opacity: 0.8;
        }
          .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }
        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        form {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f2f2f2;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }

        </style>
    <div>
        <h2>Chỉnh sửa sản phẩm</h2>
        <form method="post" action="">
            <label for="username">Tên khách hàng:</label><br>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($order['tenKhach']); ?>" required><br>
            <label for="number">Số điện thoại: </label><br>
            <input type="number" id="number" name="number" value="<?php echo htmlspecialchars($order['sdt']); ?>" required><br>
            <label for="address">Địa chỉ:</label><br>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($order['diachi']); ?>" required><br><br>
            <label for="soSP">Hàng đã đặt:</label><br>
            <input type="text" id="soSP" name="soSP" value="<?php echo htmlspecialchars($order['soSP']); ?>" required><br><br>
            <label for="price">Tổng giá trị:</label><br>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($order['tongGiaTri']); ?>" required><br><br>
            <label for="price">Trạng thái:</label><br>
            <input type="text" id="process" name="process" value="<?php echo htmlspecialchars($order['trangthai']); ?>" required><br><br>
            <input type="submit" name="update_order" value="Cập nhật đơn hàng">
        </form>
    </div>
</body>
</html>
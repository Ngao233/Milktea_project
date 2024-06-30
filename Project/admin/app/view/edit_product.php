<?php

require_once('app/model/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=signin");
    exit();
}

$db = new Database();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Sản phẩm không tồn tại.";
        exit();
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $image_link = $_POST['image_link'];
    $inv = $_POST['inv'];

    try {
        $sql_update = "UPDATE product SET name = ?, price = ?, image = ?, inv = ? WHERE id = ?";
        $stmt = $db->conn->prepare($sql_update);
        $stmt->execute([$product_name, $product_price, $image_link,$inv, $product_id]);

        echo "Sản phẩm đã được cập nhật thành công.";
        header("Location: index.php?action=product"); 
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
    <title>Chỉnh sửa sản phẩm</title>
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
            <label for="product_name">Tên sản phẩm:</label><br>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>
            <label for="product_price">Giá:</label><br>
            <input type="number" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
            <label for="image_link">Link hình:</label><br>
            <input type="text" id="image_link" name="image_link" value="<?php echo htmlspecialchars($product['image']); ?>" required><br><br>
            <label for="image_link">Tồn kho:</label><br>
            <input type="text" id="inv" name="inv" value="<?php echo htmlspecialchars($product['inv']); ?>" required><br><br>
            <input type="submit" name="update_product" value="Cập nhật sản phẩm">
        </form>
    </div>
</body>
</html>

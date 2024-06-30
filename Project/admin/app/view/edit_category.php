<?php

require_once('app/model/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=signin");
    exit();
}

$db = new Database();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = intval($_GET['id']);

    $sql = "SELECT * FROM category WHERE id = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([$category_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        echo "Thể loại không tồn tại.";
        exit();
    }
} else {
    echo "ID thể loại không hợp lệ.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_category'])) {
    $category_name = $_POST['category_name'];

    try {
        $sql_update = "UPDATE category SET loai = ? WHERE id = ?";
        $stmt = $db->conn->prepare($sql_update);
        $stmt->execute([$category_name, $category_id]);

        echo "Thể loại đã được cập nhật thành công.";
        header("Location: index.php?action=category"); 
        exit();
    } catch (PDOException $e) {
        echo "Lỗi khi cập nhật thể loại: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thể loại</title>
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
        <h2>Chỉnh sửa thể loại</h2>
        <form method="post" action="">
            <label for="category_name">Thể loại:</label><br>
            <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['loai']); ?>" required><br><br>
            <input type="submit" name="update_category" value="Cập nhật thể loại">
        </form>
    </div>
</body>
</html>
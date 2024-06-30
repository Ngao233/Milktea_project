<?php

require_once('app/model/database.php');
require_once 'admin_header.php';
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    echo "Bạn không có quyền truy cập vào trang này.";
    exit;
}
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
  $category_name = $_POST['category_name'];
  try {
      $sql_insert = "INSERT INTO category (loai) VALUES (?)";
      $stmt = $db->conn->prepare($sql_insert);
      $stmt->execute([$category_name]);
      
      echo "Thể loại đã được thêm thành công.";
  } catch (PDOException $e) {
      echo "Lỗi khi thêm thể loại: " . $e->getMessage();
      exit;
  }
}
try {
    $sql_category = "SELECT * FROM category";

    $result_category = $db->getAll($sql_category);
} catch (PDOException $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
    exit;
}
?>
<div class="admin-panel">
        <div>
            <h2>Thể loại hàng hóa</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Thể loại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_category) {
                            foreach ($result_category as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["loai"] . "</td>";
                                echo "<td>  
                                  <a href='index.php?action=edit_category&id=" . $row["id"] . "' class='btn btn-edit'>Sửa</a> | 
                                  <a href='index.php?action=delete_category&delete_id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\">Xóa</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Không có người dùng</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

        <h2>Thêm thể loại</h2>
        <form method="post" action="">
            <label for="category_name">Tên thể loại:</label><br>
            <input type="text" id="category_name" name="category_name" required><br>
            <input type="submit" name="add_category" value="Thêm thể loại">
        </form>
            </div>
        </div>
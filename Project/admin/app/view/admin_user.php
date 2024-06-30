<?php
$db = new Database();
try {
  $sql_users = "SELECT * FROM users";
  $sql_products = "SELECT * FROM product";

  $result_users = $db->getAll($sql_users);
  $result_products = $db->getAll($sql_products);
} catch (PDOException $e) {
  echo "Lỗi truy vấn: " . $e->getMessage();
  exit;
}
?>
<div class="admin-panel">
        <div>
            <h2>Khách hàng</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên khách hàng</th>
                            <th>Mật khẩu</th>
                            <th>Số điện thoại</th>
                            <th>Quyền admin</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_users) {
                            foreach ($result_users as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td>" . $row["password"] . "</td>";
                                echo "<td>" . $row["sdt"] . "</td>";
                                echo "<td>" . $row["admin"] . "</td>";
                                echo "<td>  
                                  <a href='index.php?action=edit_user&id=" . $row["id"] . "' class='btn btn-edit'>Sửa</a> | 
                                  <a href='index.php?action=delete_user&delete_id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\">Xóa</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Không có người dùng</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
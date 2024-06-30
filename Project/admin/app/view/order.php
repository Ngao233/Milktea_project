<?php

require_once('app/model/database.php');
require_once 'admin_header.php';
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    echo "Bạn không có quyền truy cập vào trang này.";
    exit;
}
$db = new Database();

try {
    $sql_orders = "SELECT * FROM donhang";

    $result_orders = $db->getAll($sql_orders);
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
                            <th>Tên khách: </th>
                            <th>Sđt: </th>
                            <th>Địa chỉ: </th>
                            <th>Hàng đã đặt: </th>
                            <th>Trạng thái: </th>
                            <th>Tổng tiền:</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_orders) {
                            foreach ($result_orders as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["tenKhach"] . "</td>";
                                echo "<td>" . $row["sdt"] . "</td>";
                                echo "<td>" . $row["diachi"] . "</td>";
                                echo "<td>" . $row["soSP"] . "</td>";
                                echo "<td>" . $row["trangthai"] . "</td>";
                                echo "<td>" . $row["tongGiaTri"] . "</td>";

                                echo "<td>  
                                  <a href='index.php?action=edit_order&id=" . $row["id"] . "' class='btn btn-edit'>Sửa</a> | 
                                  <a href='index.php?action=delete_order&delete_id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\">Xóa</a>
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
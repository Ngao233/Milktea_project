<?php

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $image_link = $_POST['image_link']; 
    $idcate = $_POST['idcate'];
    $inv = $_POST['inv'];

    try {
        $sql_insert = "INSERT INTO Product (name, price, image,inv,idcate) VALUES (?, ?, ?,?,?)";
        $stmt = $db->conn->prepare($sql_insert);
        $stmt->execute([$product_name, $product_price, $image_link,$inv, $idcate]);
        
        echo "Sản phẩm đã được thêm thành công.";
    } catch (PDOException $e) {
        echo "Lỗi khi thêm sản phẩm: " . $e->getMessage();
        exit;
    }
}

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
<div>
            <h2>Sản phẩm</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Hàng còn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      
                      if ($result_products) {
                          foreach ($result_products as $row) {
                              echo "<tr>";
                              echo "<td>" . $row["id"] . "</td>";
                              echo "<td>" . $row["name"] . "</td>";
                              echo "<td>" . $row["price"] . "</td>";
                              echo "<td>" . $row["image"] . "</td>";
                              echo "<td>" . $row["inv"] . "</td>";

                              echo "<td>  
                                      <a href='index.php?action=edit_product&id=" . $row["id"] . "' class='btn btn-edit'>Sửa</a> | 
                                      <a href='index.php?action=delete_id&delete_id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\">Xóa</a>
                                    </td>";
                              echo "</tr>";
                          }
                      } else {
                          echo "<tr><td colspan='7'>Không có sản phẩm</td></tr>";
                      }
                    
                      
                        ?>
                    </tbody>
                </table>
            </div>

            <div>
            <h2>Thêm sản phẩm mới</h2>
        <form method="post" action="">
            <label for="product_name">Tên sản phẩm:</label><br>
            <input type="text" id="product_name" name="product_name" required><br>
            <label for="product_price">Giá:</label><br>
            <input type="number" id="product_price" name="product_price" required><br>
            <label for="image_link">Link hình:</label><br>
            <input type="text" id="image_link" name="image_link" required><br><br>
            <label for="idcate">Loại hàng:</label><br>
            <input type="text" id="idcate" name="idcate" required><br><br>
            <label for="idcate">Tồn kho:</label><br>
            <input type="text" id="inv" name="inv" required><br><br>
            <input type="submit" name="add_product" value="Thêm sản phẩm">
        </form>
            </div>
        </div>
    </div>
<?php
function themVaoGioHang($tenSanPham, $giaSanPham)
{
    try {
        $db = new Database();

        $stmt = $db->conn->prepare("SELECT * FROM sanpham WHERE tenSanPham = :tenSanPham");
        $stmt->bindParam(':tenSanPham', $tenSanPham);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $stmt = $db->conn->prepare("UPDATE sanpham SET soLuong = soLuong + 1 WHERE tenSanPham = :tenSanPham");
            $stmt->bindParam(':tenSanPham', $tenSanPham);
            $stmt->execute();
        } else {
            $stmt = $db->conn->prepare("INSERT INTO sanpham (tenSanPham, giaSanPham, soLuong) VALUES (:tenSanPham, :giaSanPham, 1)");
            $stmt->bindParam(':tenSanPham', $tenSanPham);
            $stmt->bindParam(':giaSanPham', $giaSanPham);
            $stmt->execute();
        }

    } catch (PDOException $e) {
        echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    }
}


$database = new Database();

$products = $database->getProducts();
$category = $database->getCategory();

foreach($category as $type){
    echo '<div class="metqua"><h2>'.$type['loai'].'</h2></div>';
    echo "<section class='sanpham-grid'>";
    foreach($products as $row){
        if($row['idcate']==$type['id']){
            echo '<article class="sanpham">';
            echo '<a href = "index.php?page=detail&id=' . $row["id"] . '">';
            echo '  <header class="sub-header">';
            echo '    <img src="img/' . $row["image"] . '" alt="' . $row["name"] . '" />';
            echo '    <h3>' . $row["name"] . '</h3>';
            echo '  </header>';
            echo '  <p>Giá: ' . $row["price"] . '</p>';
    
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="product_name" value="' . $row["name"] . '">';
            echo '<input type="hidden" name="price" value="' . $row["price"] . '">';
            echo '<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">';
            echo '</form>';
            echo '</a>';
            echo '</article>';
        }

    }
    echo "</section>";
}


if (isset($_POST['add_to_cart'])) {
    $tenSanPham = $_POST['product_name'];
    $giaSanPham = $_POST['price'];
    themVaoGioHang($tenSanPham, $giaSanPham);
  }
?>

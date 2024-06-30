<?php
extract($detail);
if (isset($_POST['add_to_cart'])) {
  $tenSanPham = $_POST['product_name'];
  $giaSanPham = $_POST['price'];
  themVaoGioHang($tenSanPham, $giaSanPham);
}
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
?>
<section>
  <h2>Chi tiết sản phẩm</h2>
  <div class="detailproduct">
    <div class="product">
        <img src="<?php echo 'img/'.$image; ?>" />
        <h3><?php echo $name; ?></h3>
        <p>Giá: <?php echo $price; ?></p>
        <form method="post" action="">
        <input type="hidden" name="product_name" value="<?php echo $name?>">
        <input type="hidden" name="price" value="<?php echo $price?>">
        <input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">
        </form>
    </div>
  </div>
</section>
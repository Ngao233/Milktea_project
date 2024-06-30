

<?php 
session_start();
$listcate = ["Trà sữa","Trà trái cây","Ăn vặt","Tô tượng"];

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
<div class="banner">
      <img src="img/anhbia.png" alt="Banner Image" class="banner-image">
      <span class="arrow left">&#8249;</span>
      <span class="arrow right">&#8250;</span>
</div>
<section class="hot-genres">
    <h2>THỂ LOẠI</h2>
        <div class="genre-grid">
            <?php 
            foreach($listcate as $item){
                echo '<div class="genre">
                <i class="fas fa-fire"></i>
                <p>'.$item.'</p>
                </div>';
            }
            ?>
    </div>
</section>
<h2>Vị trí của quán</h2><br>

<aside class="video-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d983.0448187625868!2d104.99348379486345!3d9.750877205062674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a732848a1f4863%3A0x5b23bf27aea0aec0!2zUVgyVis3UUgsIFQ3LCDEkMO0bmcgSG_DoCwgQW4gTWluaCwgS2nDqm4gR2lhbmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2skr!4v1717956401478!5m2!1svi!2skr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <video src="./img/quangcao.mp4" controls></video>
</aside>
<br><br>
<?php
// echo "<h2>Sản phẩm mới nhất</h2>";
echo '<section class="center">';
require_once('app/model/database.php');
$database = new Database();

$products = $database->getProducts();

$count = 0; 
foreach ($products as $row) {
  if ($count >= 6) {
    break; 
  }

  echo '<article class="sanpham">';
  echo '<a href="index.php?page=detail&id=' . $row["id"] . '">';
  echo '  <header class="sub-header">';
  echo '    <img src="img/'. $row["image"] . '" alt="' . $row["name"] . '" />';
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

  $count++; 
}
?>

<br>
<?php
echo "</section>";

echo '<div class="metqua"><h2>Sản phẩm nổi bật</h2></div>';

echo "<section class='sanpham-grid'>";

if (!empty($products)) {
    foreach ($products as $row) {
        if($row['inv']>5){
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
} else {
    echo "Không có sản phẩm nào.";
}

?>
  </section>




<style>

    table {
    width: 100%;
    border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn-delete {
      text-decoration: none;
      color: #fff;
      background-color: #f44336;
      margin: 0;
      padding: 10px 20px;
      border-radius: 4px;
      border: none;
    }

    .btn-delete:hover {
      background-color: #d32f2f;
    }
    button, input[type="submit"] {
      background-color: #1a351b;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin: 20px;
    }
    .hidden-form {
            display: none;
    }

    .add_order {
    background-color: #4CAF50;
    color: white;
    height: 50px;
    width: 160px;
    justify-content: center;
    padding: 40px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    margin: 40px 20px 20px 0;
    }
    #myForm.hidden-form label{
      padding: auto;
      margin: 20px;
    }
    #myForm.hidden-form input[type="text"],
    #myForm.hidden-form input[type="number"] {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin: 20px;
  }

  </style>
      <script>
        function showForm() {
            var form = document.getElementById("myForm");
            form.style.display = "block";
        }
    </script>
  <?php

require_once('app/model/database.php');
$database = new Database();
$gioHang = $database->getCart();

function tinhTongGiaTri($gioHang) {
    $tong = 0;

    foreach ($gioHang as $sanPham) {
        $gia = $sanPham['giaSanPham'];
        $soLuong = $sanPham['soLuong'];
        $thanhTien = intval($gia) * intval($soLuong);
        $tong += $thanhTien;
    }

    return $tong;
}


$tongGiaTri = tinhTongGiaTri($gioHang);

$products = $database->getProducts();
function tongSanPham($gioHang){
  $ten ="";
  $database = new Database();
  $pro = $database->getProducts();
  foreach($gioHang as $sanPham){
    foreach($pro as $item){
      $tensp = $sanPham['tenSanPham'];
      $soLuong = $sanPham['soLuong'];
      $inv = $item['inv'];
  

      $sql = "UPDATE product SET inv = ? WHERE name = ?";
      $stmt = $database->conn->prepare($sql);
      $stmt->execute([$inv - $soLuong, $tensp]);
    }
    $thanhpham = strval($tensp).' x '.strval($soLuong);
    $ten .=' . '.$thanhpham;
  }
  return $ten;
}
$chuoi = tongSanPham($gioHang);

function refreshPage() {
  echo '<meta http-equiv="refresh" content="5">';
}

?>

<table>
  <thead>
    <tr>
      <th>Sản phẩm</th>
      <th>Giá</th>
      <th>Số lượng</th>
      <th></th> 
    </tr>
  </thead>
  <b>
    <?php foreach ($gioHang as $key => $sanPham) : ?>
      <?php
      $product = array_filter($products, function ($item) use ($sanPham) {
          return $item['name'] === $sanPham['tenSanPham'];
      });
      $product = reset($product); 
      ?>
      <tr>
        <td><?php echo $sanPham['tenSanPham']; ?></td>
        <td><?php echo $product['price']; ?></td>
        <td><?php echo $sanPham['soLuong']; ?></td>
        <td>
          <form method="post" action="app/view/delete.php">
            <input type="hidden" name="xoaSanPham" value="<?php echo $sanPham['tenSanPham']; ?>">
            <button type="submit" class="btn-delete">Xóa</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    <td><h3>Tổng tiền: <?php echo $tongGiaTri?></h3></td>
    <tr>
      <td>
      <button onclick="showForm()">Thanh toán ngay</button>

      <?php
      echo '<form id="myForm" class="hidden-form" method="post" action="">';
        echo '<label for="username">Tên người nhận:</label><br>';
        echo '<input type="text" id="username" name="username" required><br>';
        echo '<label for="number">Số điện thoại: </label><br>';
        echo '<input type="number" id="number" name="number" required><br>';
        echo '<label for="address">Địa chỉ:</label><br>';
        echo '<input type="text" id="address" name="address" required><br><br>';
        echo '<input type="hidden" name="sosp" value="' . $chuoi . '">';
        echo '<input type="hidden" name="price" value="' . $tongGiaTri . '">';
        echo '<input class="add_order" type="submit" name="add_address" value="Xác nhận mua hàng">';
      echo '</form>';
      ?>
      </td>
    </tr>

  </tbody>
</table>


<?php 

if (isset($_POST['add_address'])) {
  $tenKhach = $_POST['username'];
  $sdt = $_POST['number'];
  $diachi = $_POST['address'];
  $soSP = $_POST['sosp'];
  $tongGiaTri = $_POST['price'];

  $sql = "INSERT INTO donhang (tenKhach, sdt, diachi, soSP, tongGiaTri) VALUES ('$tenKhach', '$sdt', '$diachi', '$soSP', '$tongGiaTri')";
  $sql_insert = "INSERT INTO donhang SET tenKhach =? ,sdt = ?,diachi = ?,soSP = ?, tongGiaTri = ?";
  $stmt = $database->conn->prepare($sql_insert);
  $stmt->execute([$tenKhach, $sdt, $diachi, $soSP, $tongGiaTri]);
  

  $xoa = $database->deleteSanPham();
  echo "Đơn hàng đã được tạo thành công!";
  refreshPage();
}


?>

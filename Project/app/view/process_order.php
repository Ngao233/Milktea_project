<form method="post" action="">
            <label for="username">Tên người nhận:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="number">Số điện thoại: </label><br>
            <input type="number" id="number" name="number" required><br>
            <label for="address">Địa chỉ:</label><br>
            <input type="text" id="address" name="address" required><br><br>
            <input type="submit" name="add_address" value="Thêm sản phẩm">
        </form>

<?php 

if (isset($_POST['order']) && isset($_POST['add_address'])) {
  $tenKhach = $_POST['username'];
  $sdt = $_POST['number'];
  $diachi = $_POST['address'];
  $soSP = $_POST['name'];
  $tongGiaTri = $_POST['price'];

  $sql = "INSERT INTO donhang (tenKhach,sdt,diachi,soSP, tongGiaTri) VALUES ('$tenKhach','$sdt','$diachi','$soSP', '$tongGiaTri')";

  echo "Đơn hàng đã được tạo thành công!";
  $xoa = $database->deleteSanPham();
  header("Location: index.php?action=cart"); 

}

?>
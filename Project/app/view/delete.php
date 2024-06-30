<?php
require_once '../model/database.php';
function xoaSanPham($tenSanPham) {
  $conn = new Database();
  $conn->getCart();


  $query = "DELETE FROM sanpham WHERE tenSanPham = '$tenSanPham'";
  $result = $conn->query($query);

  if ($result) {
    echo "Xóa sản phẩm thành công.";
    header('Location: /asm1/index.php?page=cart');

  } else {
    echo "Lỗi xóa sản phẩm: " ;

  }

}

if (isset($_POST['xoaSanPham'])) {
  $tenSanPham = $_POST['xoaSanPham'];
  xoaSanPham($tenSanPham);
}
?>
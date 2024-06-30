<style>
    .info-box {
  width: 200px;
  text-align: center;
  padding: 20px;
  margin: 10px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  background: linear-gradient(45deg, #002D62, #6CB4EE);
  color: white;
}
h1{
}
</style>
<?php

require_once('app/model/database.php');
require_once 'admin_header.php';
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    echo "Bạn không có quyền truy cập vào trang này.";
    exit;
}

$db = new Database();
try {
    $sql_users = "SELECT * FROM users";
    $sql_products = "SELECT * FROM product";
    $sql_orders = "SELECT * FROM donhang";
    $result_orders_thanhcong = $db->countOrder();
    $sql_revenue_today = "SELECT SUM(tongGiaTri) AS revenue_today FROM donhang WHERE trangthai = 'Đã giao' AND DATE(created_at) = CURDATE()";
    $result_users = $db->getAll($sql_users);
    $result_products = $db->getAll($sql_products);
    $result_orders = $db ->getAll($sql_orders);
    $result_inv = $db->countInv();
    $result_orders_danggiao = $db->countOrderNot();
    $result_revenue = $db-> allDayRevenue();

} catch (PDOException $e) {
    echo "Lỗi truy vấn: " . $e->getMessage();
    exit;
}
?>
    <center><h1 id="admin-panel">Admin Panel</h1></center>
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <div class ="info-box">
            <h3>Tổng khách hàng</h3>
            <h2><?php echo count($result_users); ?></h2>
        </div>
        <div class ="info-box">
            <h3>Tổng sản phẩm</h3>
            <h2><?php echo count($result_products); ?></h2>
        </div>
        <div class ="info-box">
            <h3>Đơn hàng</h3>
            <h2><?php echo count($result_orders); ?></h2>
        </div>
        <div class ="info-box">
            <h3>Hàng sắp hết tồn kho</h3>
            <h2><?php echo $result_inv; ?></h2>
        </div>
        <div class="info-box">       
            <h3>Đơn đang giao</h3>
            <h2><?php echo $result_orders_danggiao; ?></h2>
        </div>
        <div class="info-box">       
            <h3>Đơn đã giao</h3>
            <h2><?php echo $result_orders_thanhcong; ?></h2>
        </div>
        <div class="info-box">       
            <h3>Tổng doanh thu</h3>
            <h2><?php echo $result_revenue."VNĐ"; ?></h2>
        </div>
    </div>
    

       
    <script>
        function changeColor() {
            var colors = ['#ff0000', '#ffa500', '#ffff00', '#008000', '#0000ff', '#4b0082', '#9400d3'];
            var title = document.getElementById('admin-panel');
            var index = Math.floor(Math.random() * colors.length);
            title.style.color = colors[index];
        }

        setInterval(changeColor, 1000);
    </script>

    <?php
    require_once 'order.php';

    ?>
</body>
</html>

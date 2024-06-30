<?php
require_once 'app/model/AdminModel.php';

class AdminController {
    public function index() {
        // Gọi các phương thức trong model để lấy dữ liệu
        $model = new AdminModel();
        $users = $model->getUsers();
        $orders = $model->getOrders();

        // Chuyển dữ liệu sang view
        include 'app/view/admin_view.php';

    }
    
    
    
    

    // Các phương thức khác để xử lý các yêu cầu khác từ người dùng
}
?>

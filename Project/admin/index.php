<?php
session_start();
require_once 'app/controller/AdminController.php';
require_once 'app/model/database.php';
require_once('app/view/admin_header.php');
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new AdminController();

switch ($action) {

    case 'index':
        $controller->index();
        break;
    case 'add':
        include 'app/view/add_product.php';
        break;
    case 'delete_id':
        if (isset($_GET['delete_id'])) {
            $db = new Database();
                    
            $product_id = $_GET['delete_id'];
            
            try {
                $sql_delete = "DELETE FROM product WHERE id = ?";
                $stmt = $db->conn->prepare($sql_delete);
                $stmt->execute([$product_id]);
                        
                header("Location: index.php?action=index"); 
                exit; 
                } catch (PDOException $e) {
                echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
                exit;
                }
            }
            exit; 
               
    case 'user':
        include 'app/view/admin_user.php';
        break;
    case 'product':
        include 'app/view/admin_product.php';
        break;
    case 'category':
        include 'app/view/admin_category.php';
        break;
    case 'edit_product':
        include 'app/view/edit_product.php';
        break;
    case 'edit_user':
        include 'app/view/edit_user.php';
        break;
    case 'delete_user':
        include 'app/view/delete_user.php';
        break;
    case 'edit_category':
        include 'app/view/edit_category.php';
        break;
    case 'delete_category':
        include 'app/view/delete_category.php';
        break;
    case 'order':
        include 'app/view/order.php';
        break;
    case 'edit_order':
        include 'app/view/edit_order.php';
        break;
    case 'delete_order':
        include 'app/view/delete_order.php';
        break;
    case 'signout':
        session_unset();
        session_destroy();
        header('location: ../');
        exit;
}
            

?>

<?php 
require_once('app/model/database.php');
include_once('app/model/CategoryModel.php');
require_once('app/view/header.php');
require_once('app/controller/HomeController.php');

$database = new Database(); 
$products = $database->getProducts(); 

if(isset($_GET['page'])){
  $page = $_GET['page'];
  switch ($page){
    case 'detail':
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        foreach($products as $product){
          if($product['id'] == $id){
            $detail = $product;
            require_once('app/view/detail.php');
            break;
          }
        }
      } else {
        require_once 'app/view/home.php';
        break;
      }
      break;

    case 'signin':
      include 'app/view/signin.php';
      break;
    case 'signout':
      session_unset();
      session_destroy();
      header('location: index.php');
      exit;
    case 'register':
      include 'app/view/register.php';
      break;
    case 'cart':
      require_once 'app/view/cart.php';
      break;
    case 'list':
      require_once 'app/view/list.php';
      break;
    case 'session':
      require_once 'app/view/session_info.php';
      break;
    case 'process_order':
      require_once 'app/view/process_order.php';
      break;
    case 'delete_id':
        if (isset($_GET['delete_id'])) {
            $db = new Database();
            
            $product_id = $_GET['delete_id'];
    
            try {
                $sql_delete = "DELETE FROM sanpham WHERE id = ?";
                $stmt = $db->conn->prepare($sql_delete);
                $stmt->execute([$product_id]);
                
                header("Location: index.php?page=cart"); 
                exit; 
            } catch (PDOException $e) {
                echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
                exit;
            }
        }
        exit;
    default:
      $home = new HomeController();
      $home->view($database);
      break;
    }
  } else {
    $home = new HomeController();
    $home->view($database);
  }


require_once('app/view/footer.php');




?>


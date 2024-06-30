<?php
        if (isset($_GET['delete_id'])) {
          $db = new Database();
                  
          $user_id = $_GET['delete_id'];
          
          try {
              $sql_delete = "DELETE FROM category WHERE id = ?";
              $stmt = $db->conn->prepare($sql_delete);
              $stmt->execute([$user_id]);
                      
              header("Location: index.php?action=category"); 
              exit; 
              } catch (PDOException $e) {
              echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
              exit;
              }
          }
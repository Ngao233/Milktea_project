

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
    table {
  width: 100%; 
  border-collapse: collapse; 
}

th, td {
  padding: 10px; 
  border: 1px solid #ccc; 
  text-align: left; 
}

th {
  background-color: #f2f2f2; 
}

h2 {
  margin-top: 30px; 
  text-align: center;
  font-size: 1.5em;
}

.table-container {
  margin-top: 20px; 
  overflow-x: auto; 
}

.admin-panel > div {
  padding: 20px; 
}
.btn {
  padding: 8px 16px;
  text-decoration: none;
  color: white;
  border-radius: 4px;
  margin-right: 5px;
}
.btn-edit {
  background-color: #4CAF50; 
}
.btn-delete {
  background-color: #f44336; 
}
.btn:hover {
  opacity: 0.8;
}
.form-container {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 300px;
  text-align: center;
}
.form-container h2 {
  margin-bottom: 20px;
}
.form-container label {
  display: block;
  margin-bottom: 8px;
  text-align: left;
}
.form-container input[type="text"],
.form-container input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.form-container input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
}
.form-container input[type="submit"]:hover {
  background-color: #45a049;
}
form {
max-width: 1200px;
margin: 0 auto;
padding: 20px;
border: 1px solid #ccc;
border-radius: 5px;
background-color: #f2f2f2;
}

label {
display: block;
margin-bottom: 10px;
font-weight: bold;
}

input[type="text"],
input[type="number"] {
width: 100%;
padding: 10px;
margin-bottom: 10px;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}

input[type="submit"] {
width: 100%;
padding: 10px;
border: none;
border-radius: 4px;
background-color: #4CAF50;
color: white;
cursor: pointer;
}

.error {
color: red;
margin-bottom: 10px;
}

.big-header {
    background-color: #f8f9fa; 
    padding: 20px;           
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.big-header nav {
    display: flex;
    justify-content: center; 
}

.big-header nav ul {
    list-style: none;   
    padding: 0;             
    margin: 0;              
    display: flex;
    gap: 15px;             
}

.big-header nav ul li {
    display: inline;       
}

.big-header nav ul li a {
    text-decoration: none; 
    color: #333;          
    font-weight: bold;      
    padding: 10px 15px;     
    transition: background-color 0.3s; 
}

.big-header nav ul li a:hover {
    background-color: #007bff; 
    color: #fff;               
    border-radius: 5px;        
}

.big-header nav ul li a.active {
    background-color: #007bff; 
    color: #fff;              
    border-radius: 5px;        
}
</style>
</head>
    <header class="big-header">
        <nav>
            <ul>
                <li><a href="index.php?page=index">Trang chủ</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li><a>Xin chào {$_SESSION['username']}</a></li>";
                    echo "<li><a href='index.php?action=order'>Đơn hàng</a></li>";
                    echo "<li><a href='index.php?action=user'>Người dùng</a></li>";
                    echo "<li><a href='index.php?action=product'>Sản phẩm</a></li>";
                    echo "<li><a href='index.php?action=category'>Phân loại</a></li>";
                    echo "<li><a href='index.php?action=signout'>Đăng xuất</a></li>";
                } else {
                    echo "<li><a href='index.php?page=signin'>Đăng nhập</a></li>";
                    echo "<li><a href='index.php?page=register'>Đăng ký</a></li>";
                }    
                ?>
            </ul>
        </nav>
    </header>
</body>
</html>